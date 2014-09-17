module.exports = function (grunt, options) {

  return {
    'requirejswithconfig': {
      options: {
        beautify: options.beautify
      },

      src: [options.buildDir+'/config.js', options.libDir+'/shimney/requirejs/main.js'],
      dest: options.buildDir+'/load-require.js'
    }
  };
};
