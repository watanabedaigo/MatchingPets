// ・マウスオーバーイベントを用いて、カーソルが乗っているカテゴリー、品種の色を変える。
// ・toPageTopディレクトリを参考に、ページトップに移動するボタンを実装。
// ・（accordionをディレクトリ参考に、候補一覧で候補をクリックすると、候補詳細が下に広がるように表示するようにする？
// 　　またはBootstrapのモーダルを実装し、元の画面に覆いかぶさるように表示する？）
// 　メリット
// 　　・ページ遷移が減る。
// 　デメリット　
//　 　・候補詳細に飛ぶ際、候補テーブルのview_countカラムを１ずつ足しており、それにより閲覧回数を管理している。
// 　　　この機能を実装すると、ページ遷移するわけではないので、現在のコードでの閲覧回数の管理ができなくなってしまう？
// ・MagnificPopupライブラリを用いて、候補詳細の写真のライトボックスを実装

// ・インスタのWebAPIを用いて、候補の写真や動画を載せる？
// 　重くなってしまうため、リンクだけを貼る？

const containerheight = $("#background").height();
const windowheight = $(window).height();
if(containerheight < windowheight){
  $("#background").css("height",windowheight + "px")
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
  console.log('sort click');
  
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

$('.popup').magnificPopup({
  type: 'image',
  gallery: { enabled: true },
  mainClass: 'mfp-fade',
  removalDelay: 300,
});

const windowwidth = $(window).width();
console.log(windowwidth);
if(windowwidth <= 375){
  $('iframe').css({
    'width':'300',
    'height':'300',
  });
}