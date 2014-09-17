module.exports = function(grunt, options) {

  return {
    'build-dev': {
      files: [
        // copy twitter-bootstrap
        {expand: false, src: [options.libDir+'/shimney/twitter-bootstrap/css/bootstrap.css'], dest: 'Resources/assets/css/bootstrap.css'},

        // copy all libs to build dir
        {expand: true, cwd: options.libDir, src: ['**/*.js'], dest: options.buildDir+'/lib'}
     ]
    }
  };
};