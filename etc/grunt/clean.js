module.exports = function(grunt, options) {
  return {
    options: {
      force: true
    },
    src: [options.buildDir]
  };
};