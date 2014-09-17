function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: '/plugins/elfinder/elfinder.html',// use an absolute path!
    title: 'elFinder 2.0',
    width: 900,  
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      //console.log('in setUrl: ' + url);
      
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}
