module.exports = function (grunt, options) {
  return {
    cms: {
      options: {
        src: 'Resources/assets/js',
        dir: options.buildDir,

        "merge-configs": {
          modify: function(mergedConfig) {
            mergedConfig.urlArgs = "version="+(new Date()).getTime();
            mergedConfig.baseUrl =  '/js/lib';

            delete mergedConfig.paths.app;
          }
        },

        requirejs: {
          modules: [
            {
              name: "boot",
              include: [
                "tiptoi/Main",
                "tiptoi/GameMaker",
                "tiptoi/GameSimulator",
                "tiptoi/TitoGameEditor",
                "Psc/CMS/Service",
                "app/matrix-manager",
                "app/mm-template",

                "Psc/UI/CodeEditor",
                "Psc/UI/GridTableEditor",

                "Psc/UI/GridPanel",

                'Psc/UploadService',

                'Psc/UI/DateTimePicker',
                
                'Psc/UI/jqx/I18nWrapper',

                'Psc/UI/DropBox',
                'Psc/UI/ComboDropBox',
                'Psc/UI/Group',

                "tiptoi/SoundImporter",
                "tiptoi/SoundImporterBackend"
              ]
            }
          ],

          // set this to uglify2 for real deployment
          "optimize": "uglify2"
        }
      }
    },

    options: {
      // make sure you have done npm install in this psc-cms-js-src directory
      'psc-cms-js-src': options['psc-cms-js-src'],
      tmp: 'files/cache/js-tmp'
    }
  };
};
