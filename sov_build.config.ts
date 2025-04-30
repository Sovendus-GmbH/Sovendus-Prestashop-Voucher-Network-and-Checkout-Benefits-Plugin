import type { BuildConfig } from "sovendus-builder";

const buildConfig: BuildConfig = {
  foldersToClean: ["ps_sovendus/views/js"],
  filesToCompile: [
    {
      sovOptions: {
        input: "ps_sovendus/views/ts/admin_settings.ts",
        output: "ps_sovendus/views/js/admin_settings.js",
        type: "react-tailwind",
        bundleReact: true,
      },
    },
    {
      sovOptions: {
        input: "ps_sovendus/views/ts/sovendus-page.ts",
        output: "ps_sovendus/views/js/sovendus-page.js",
        type: "vanilla",
      },
    },
    {
      sovOptions: {
        input: "ps_sovendus/views/ts/thankyou-page.ts",
        output: "ps_sovendus/views/js/thankyou-page.js",
        type: "vanilla",
      },
    },
  ],
  filesOrFoldersToCopy: [
    {
      input:
        "node_modules/sovendus-integration-settings-ui/dist/logos/sovendus-logo.png",
      output: "ps_sovendus/logo.png",
    },
  ],
};

export default buildConfig;
