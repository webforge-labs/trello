var nodepath = require('path');

module.exports = {
  'amd': {
    binderName : "amd",
    templates : "Resources/templates/**/*.mustache",
    output : "Resources/assets/js/templates-compiled.js",
    nameFunc: function(fileName) {
      fileName = nodepath.normalize(fileName);

      var pathParts = fileName.split(nodepath.sep).slice(['Resources', 'templates'].length, -1);
      var namespace = pathParts.length > 0 ? pathParts.join('.')+'.' : '';

      var templateName = namespace+nodepath.basename(fileName, nodepath.extname(fileName));
      return templateName;
    }
  }
};