import React from "react";
import { createRoot } from "react-dom/client";
import { loggerError, loggerInfo } from "sovendus-integration-settings-ui";
import { SovendusBackendForm } from "sovendus-integration-settings-ui";
import type { SovendusAppSettings } from "sovendus-integration-types";

/**
 * Window interface extension for Sovendus settings
 */
declare global {
  interface Window {
    sovendusSettings: {
      settings: SovendusAppSettings;
      ajaxurl: string; // PrestaShop admin AJAX URL
      nonce: string;
    };
  }
}

/**
 * Default settings - these will be used if no settings are found
 */
const DEFAULT_SETTINGS = {
  version: "3",
  // Add other default settings here as needed
} as SovendusAppSettings;

/**
 * Load the settings UI
 *
 * This function initializes the Sovendus settings UI by:
 * 1. Checking if the required global settings are available
 * 2. Getting the current settings or using defaults
 * 3. Finding the container element
 * 4. Rendering the settings form
 */
function loadSettingsUi(): void {
  try {
    loggerInfo("Initializing Sovendus settings UI");

    // Check if sovendusSettings is available
    if (!window.sovendusSettings) {
      throw new Error(
        "window.sovendusSettings is not defined - make sure the PHP template is correctly rendering the settings",
      );
    }

    // Get settings from the window object or use defaults
    const currentSettings =
      window.sovendusSettings.settings || DEFAULT_SETTINGS;

    // Get the AJAX URL for saving settings
    const saveUrl = window.sovendusSettings.ajaxurl;
    if (!saveUrl) {
      throw new Error(
        "AJAX URL is not defined - make sure the PHP template is correctly rendering the ajaxurl",
      );
    }

    // Find the container element
    const containerId = "sovendus-settings-container";
    const container = document.getElementById(containerId);
    if (!container) {
      throw new Error(
        `Container with id ${containerId} not found - make sure the PHP template includes this element`,
      );
    }

    /**
     * Handle settings updates
     *
     * @param updatedSettings The updated settings to save
     * @returns A promise that resolves with the updated settings
     */
    const handleSettingsUpdate = async (
      updatedSettings: SovendusAppSettings,
    ): Promise<SovendusAppSettings> => {
      // Create a form element for traditional form submission
      const form = document.createElement("form");
      form.method = "POST";
      form.action = saveUrl;
      form.style.display = "none";

      /**
       * Add a field to the form
       *
       * @param name The name of the field
       * @param value The value of the field
       */
      const addField = (name: string, value: string): void => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        form.appendChild(input);
      };

      // Add the required fields
      addField("ajax", "1");
      addField("action", "saveSettings");
      addField("settings", JSON.stringify(updatedSettings));

      // Create a promise to handle the response
      return new Promise<SovendusAppSettings>((resolve, reject) => {
        try {
          // Create an iframe to handle the response
          const iframe = document.createElement("iframe");
          iframe.name = "sovendus-save-frame";
          iframe.style.display = "none";
          document.body.appendChild(iframe);

          // Set up the form to target the iframe
          form.target = "sovendus-save-frame";
          document.body.appendChild(form);

          // Handle iframe load event
          iframe.onload = (): void => {
            // Wait a bit to ensure the response is fully loaded
            setTimeout(() => {
              // Clean up
              if (document.body.contains(iframe)) {
                document.body.removeChild(iframe);
              }
              if (document.body.contains(form)) {
                document.body.removeChild(form);
              }

              // Assume success if we got here
              loggerInfo("Settings saved successfully");
              resolve(updatedSettings);
            }, 500);
          };

          // Handle errors
          iframe.onerror = (): void => {
            // Clean up
            if (document.body.contains(iframe)) {
              document.body.removeChild(iframe);
            }
            if (document.body.contains(form)) {
              document.body.removeChild(form);
            }

            reject(new Error("Failed to save settings"));
          };

          // Submit the form
          form.submit();
        } catch {
          loggerError("Save failed");
          reject(new Error("Failed to save settings"));
        }
      });
    };

    // Render the settings form using React
    const root = createRoot(container);
    loggerInfo("Rendering Sovendus settings form");

    // Render the SovendusBackendForm component
    root.render(
      React.createElement(SovendusBackendForm, {
        currentStoredSettings: currentSettings,
        saveSettings: handleSettingsUpdate,
        callSaveOnLoad: false,
      }),
    );
  } catch (error) {
    // Handle any errors that occurred during initialization
    const errorMessage =
      error instanceof Error ? error.message : "Unknown error";
    loggerError(`Failed to initialize settings UI: ${errorMessage}`);

    // Display a simple error message to the user
    const container = document.getElementById("sovendus-settings-container");
    if (container) {
      container.innerHTML = `<div class="alert alert-danger">Error loading Sovendus settings: ${errorMessage}</div>`;
    }
  }
}

loadSettingsUi();
