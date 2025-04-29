import type { ReleaseConfig } from "sovendus-release-tool";

const releaseConfig: ReleaseConfig = {
  packages: [
    {
      directory: "./",
      release: {
        version: "2.0.0",
        versionBumper: [
          {
            filePath: "ps_sovendus/constants.php",
            varName: "SOVENDUS_VERSION",
          },
        ],
      },
      updateDeps: true,
      lint: true,
      build: true,
      test: false,
    },
  ],
};
export default releaseConfig;
