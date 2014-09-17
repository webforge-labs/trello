module.exports = function(grunt, options) {
  return {
    'shimney': {
      options: {
        dir: options.libDir,
        baseUrl: 'lib/',
        configFile: options.srcDir+'/config-shimney.js'
      }
    }
  };
};