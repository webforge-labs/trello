module.exports = function(grunt, options) {

  return {
    'build-dev': {
      options: {
        configFiles: [
          options.srcDir+'/config-shimney.js',
          options.srcDir+'/config.js',
          options.srcDir+'/config-dev.js'
        ],

        targetFile: options.buildDir+'/config.js',

        modify: function(mergedConfig) {
          mergedConfig.urlArgs = "version="+(new Date()).getTime(); // benutze die zeit einmal für den ganzen build (das ist viel cooler als immer zu busten)
        },

        template: 'etc/js/config-template.js'
      }
    }
  };
};