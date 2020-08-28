let mainBoardMouseX = 0;
let mainBoardMouseY = 0;

function contentBoardMouseDown(that) {
  if (event.which === 3) {
    let rcMenu = document.getElementById('rc_menu');
    rcMenu.style.display = "block";
    rcMenu.style.left = mainBoardMouseX + 'px';
    rcMenu.style.top = mainBoardMouseY + 'px';
  }
}

function contentBoardMouseUp() {

}

function mouseMoveOnMainBoard(){
 mainBoardMouseX = window.event.offsetX;
 mainBoardMouseY = window.event.offsetY;
}
