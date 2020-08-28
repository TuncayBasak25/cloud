function setEqualHeight(element){
  element.style.height = element.getBoundingClientRect().width + 'px';
}

function iconEqualHeight() {
  let elementList = Array.from(document.getElementsByClassName('content_icon'));
  console.log(elementList);
  elementList.forEach( function (element) {
    setEqualHeight(element);
  });

}
