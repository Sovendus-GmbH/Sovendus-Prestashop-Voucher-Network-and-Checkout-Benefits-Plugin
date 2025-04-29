# Development Guide for Sovendus PrestaShop Plugin

This document provides instructions for setting up and working with the test server for the Sovendus PrestaShop plugin.

## Prerequisites

Ensure you have the following installed on your system:

- Docker
- yarn

## Setting Up the Test Server

1. Clone the repository and navigate to the project directory.

2. Run the `run-dev-docker.sh` script to set up the Docker containers:

   ```bash
   yarn dev
   ```

   This script performs the following actions:
   - Creates a Docker network named `prestashop-net`.
   - Starts a MySQL container with the necessary database configuration.
   - Runs a PrestaShop container with the `ps_sovendus` module mounted.

3. Access the PrestaShop instance in your browser at `http://localhost:8080`.

## Working with the Plugin

- The `ps_sovendus` module is mounted into the PrestaShop container. Any changes made to the module files in the `ps_sovendus` directory will be reflected in the running PrestaShop instance.

- To test changes, refresh the PrestaShop admin or frontend as needed.

### TypeScript Development

The module uses TypeScript for better type safety and developer experience. The TypeScript files are located in the `ps_sovendus/views/ts/` directory.

To work with TypeScript:

1. Make sure you have Node.js and yarn installed
2. Run `yarn install` to install dependencies
3. Edit the TypeScript files in the `ps_sovendus/views/ts/` directory
4. Run `yarn build` to compile the TypeScript files to JavaScript
5. The compiled JavaScript files will be placed in the `ps_sovendus/views/js/` directory

Important notes:

- Default settings are handled in the TypeScript files, not in PHP
- The TypeScript files include proper type definitions for better code quality
- Always compile the TypeScript files before testing changes

## Stopping the Test Server

To stop and remove the containers, run:

```bash
docker stop prestashop presta-mysql
docker rm prestashop presta-mysql
```

## Troubleshooting

- If you encounter issues with the database, ensure the `presta-mysql` container is running and properly configured.
- Check the logs of the containers for errors using:

  ```bash
  docker logs prestashop
  docker logs presta-mysql
  ```

## Notes

- The PrestaShop container uses the latest version of PrestaShop by default. The `ps_sovendus` module is designed to be compatible with PrestaShop versions from 1.7.0.0 to the latest, including 8.2.1.
- The MySQL container uses default credentials as specified in the `run-dev-docker.sh` script. Update these if needed for security.
- Default settings are handled in the TypeScript files, not in PHP.
- The module uses modern PHP array syntax (`[]` instead of `array()`) for better readability.
- TypeScript files are provided for better type safety and developer experience.

## Compatibility

The Sovendus module is designed to be compatible with:

- PrestaShop versions 1.7.0.0 and above
- PrestaShop 8.2.1
- PHP 7.1 and above

### Compatibility Features

The module includes several features to ensure compatibility with different PrestaShop versions:

1. **Multiple JavaScript Loading Methods**: Uses both direct script tags and PrestaShop's JavaScript registration methods
2. **Multiple Hook Support**: Uses appropriate hooks for different PrestaShop versions
3. **Modern PHP Syntax**: Uses modern PHP array syntax and features for better maintainability
4. **TypeScript Support**: Includes TypeScript files for better type safety and developer experience
5. **Error Handling**: Includes robust error handling that works across different PrestaShop versions
