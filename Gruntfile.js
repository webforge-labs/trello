/* globals process:true */
module.exports = function(grunt) {

  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  require('load-grunt-config')(grunt, {
    configPath: require('path').join(process.cwd(), 'etc', 'grunt'),
    init: true,
    loadGruntTasks: {
      pattern: ['grunt-*'],
    },
    data: {
      srcDir: 'src/js',
      libDir: "src/js/lib",
      buildDir: "www/assets/js"
    },
  });

  //grunt.task.registerTask('build-dev', ['clean', 'cssmin', 'jshint', 'hogan', 'copy:build-dev', 'sweepout:psc-cms', 'sweepout:tiptoi', 'merge-configs:build-dev']);
  grunt.task.registerTask('build-dev', ['clean', 'sweepout', 'copy:build-dev', 'merge-configs:build-dev', 'uglify:requirejswithconfig', 'cssmin']);

};