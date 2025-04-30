import type { ReleaseConfig } from "sovendus-release-tool";

const releaseConfig: ReleaseConfig = {
  packages: [
    {
      directory: "./",
      release: {
        version: "2.0.4",
        foldersToZip: [
          {
            input: "ps_sovendus",
            output: "releases/%NAME%_%VERSION%.zip",
          },
          {
            input: "ps_sovendus",
            output: "releases/%NAME%_latest.zip",
          },
        ],
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
