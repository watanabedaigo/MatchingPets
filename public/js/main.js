const containerheight = $("#background").height();
const windowheight = $(window).height();
if(containerheight < windowheight){
  $("body").css("height",(windowheight) + "px")
}

$('#subtitle').on('click',() => {
  if($('#search').hasClass('hide')){
    $('#search').removeClass('hide');
    $('#updown').removeClass('fa-sort-down');
    $('#updown').addClass('fa-sort-up').css('vertical-align','-4');
  }else{
    $('#search').addClass('hide');
    $('#updown').removeClass('fa-sort-up');
    $('#updown').addClass('fa-sort-down').css('vertical-align','0');
  }
});

$('#sort').on('click',() => {
  const created = document.forms.searchSort.sortCreated.checked;
  const price = document.forms.searchSort.sortPrice.checked;
  const age = document.forms.searchSort.sortAge.checked;
  const visited = document.forms.searchSort.sortVisited.checked;
  
  // $(this).addClass('selected'); 
  
  if(created == true){
    console.log('created');
    $('#created').css('background-color','darkseagreen');
    $('#pricesort,#age,#visited').css('background-color','snow');
  }else if(price == true){
    console.log('pricesort');
    $('#pricesort').css('background-color','darkseagreen');
    $('#created,#age,#visited').css('background-color','snow');
  }else if(age ==true){
    console.log('age');
    $('#age').css('background-color','darkseagreen');
    $('#pricesort,#created,#visited').css('background-color','snow');
  }else if(visited == true){
    console.log('visited');
    $('#visited').css('background-color','darkseagreen');
    $('#pricesort,#age,#created').css('background-color','snow');
  }
});

$(window).on('load resize', () => {
  const windowwidth = $(window).width();
  const mapshow = $('#mapshow');
  
  if(windowwidth >= 768 ){
    $('.removefavorite').html('<i class="fas fa-heart"></i><span class="text-dark">お気に入りから外す</span>');
    $('.addfavorite').html('<i class="far fa-heart"></i><span class="text-dark">お気に入りに追加</span>');

    $('#candidate-img-wrap').append(mapshow);
    mapshow.addClass('p-0');
  }else{
    $('.removefavorite').html('<i class="fas fa-heart"></i>');
    $('.addfavorite').html('<i class="far fa-heart"></i>');

    $('#candidate-wrap').append(mapshow);
    mapshow.removeClass('p-0')
  }
  
  const mapshowwidth = $('#mapshow').width();
  $('iframe').css({
    'width':mapshowwidth,
    'height':mapshowwidth,
  });
  
  if(windowwidth <= 575){
    $('.nav-link').removeClass('btn-warning');
  }else{
    $('.nav-link').addClass('btn-warning');
  }
});

$('.popup').magnificPopup({
  type: 'image',
  gallery: { enabled: true },
  mainClass: 'mfp-fade',
  removalDelay: 300,
});