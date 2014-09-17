module.exports = {
  build: {
    files: ['Resources/assets/**/*.js'],
    tasks: ['build'],
    options: {
      spawn: false,
      atBegin: true
    }
  },

  hogan: {
    files: ['Resources/tpl/**/*.mustache'],
    tasks: ['hogan'],
    options: {
      spawn: false,
      atBegin: true
    }
  }
};
