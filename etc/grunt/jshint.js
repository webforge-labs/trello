module.exports = {
  files: ['Gruntfile.js', 'Resources/assets/js/**/*.js', '!Resources/assets/js/tests/Games/SearchAndFindTest.js'],
  options: {
    curly: false, /* dont blame for missing curlies around ifs */
    eqeqeq: false,
    immed: true,
    latedef: true,
    devel: false,
    newcap: true,
    noarg: true,
    sub: true,
    undef: true,
    trailing: false,
    boss: true,
    eqnull: true,
    browser: true,
    jquery: true,
    globals: {
      $: true,
      define: true, require: true,

      Psc: true,
      tiptoi: true,
      CoMun: true,
      QUnit: true, module: true, stop: true, start: true, ok: true, asyncTest: true, test: true, expect: true, fail: true
    }
  }
};