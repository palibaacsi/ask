document.getElementsByClass = function(needle) {
  function acceptNode(node) {
    if (node.hasAttribute("class")) {
      var c = " " + node.className + " ";
       if (c.indexOf(" " + needle + " ") != -1)
         return NodeFilter.FILTER_ACCEPT;
    }
    return NodeFilter.FILTER_SKIP;
  }
  var treeWalker = document.createTreeWalker(document.documentElement,
      NodeFilter.SHOW_ELEMENT, acceptNode, true);
  var outArray = new Array();
  if (treeWalker) {
    var node = treeWalker.nextNode();
    while (node) {
      outArray.push(node);
      node = treeWalker.nextNode();
    }
  }
  return outArray;
}

window.onload = function(){
            
    /*
     * This hook adds autosizing functionality
     * to your textarea
     */
    BehaveHooks.add(['keydown'], function(data){
        var numLines = data.lines.total,
            fontSize = parseInt( getComputedStyle(data.editor.element)['font-size'] ),
            padding = parseInt( getComputedStyle(data.editor.element)['padding'] );
        data.editor.element.style.height = (((numLines*fontSize)+padding))+'px';
    });
    
    /*
     * This hook adds Line Number Functionality
     */
    BehaveHooks.add(['keydown'], function(data){
        var numLines = data.lines.total,
            house = document.getElementsByClassName('line-nums')[0],
            html = '',
            i;
        for(i=0; i<numLines; i++){
            html += '<div>'+(i+1)+'</div>';
        }
        house.innerHTML = html;
    });
    
    var editor = new Behave({
        textarea:       document.getElementsByClass('textarea'),
        replaceTab:     true,
        softTabs:       true,
        tabSize:        4,
        autoOpen:       true,
        overwrite:      true,
        autoStrip:      true,
        autoIndent:     true
    });
    
};

jQuery( '<div class="line-nums"></div>' ).insertBefore( '#acf-field-field_5419cb038fa47_0_field_5419cb788fa49' );