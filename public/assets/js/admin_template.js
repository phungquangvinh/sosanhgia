function readURL(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			$('#show-img #img-upload').attr('src', e.target.result);
			$('#show-img #img-upload').css('display', 'inline-block');
			$('#close').css('display', 'inline-block');
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function readURL2(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#show-img #img-upload').attr('src', e.target.result);
      $('#show-img #img-upload').css('display', 'inline-block');
      $('#close').css('display', 'inline-block');
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(".picture2").change(function() {
	readURL(this);

  if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      // $(this).parent().children('.show-img2').children('.img-upload2').attr('src', e.target.result);
      // $(this).parent().children('.show-img2').children('.img-upload2').css('display', 'inline-block');
      $('#close').css('display', 'inline-block');
      $(this).parent().find('.show-img2').hide()
      // console.log($(this).parent().find('.show-img2').hide());
    }

    reader.readAsDataURL(this.files[0]);
  }
});

$("#picture2").change(function() {
  readURL(this);
});

function close_window() {
		// $('#show-img #img-upload').css('display', 'none');
		$('#close').css('display', 'none');
		$('#show-img #img-upload').attr('src', "/assets/images/no-image.png");
		$('input').val("");
	}

	 // $.ajax({
  //       url: url,
  //       type: 'POST',
  //       dataType:'json',
  //       asyc:true,
  //       data: {
  //           "title":$(this).val(),
  //       },
  //       success: function(data) {
  //           var ckUnit='';

  //           $.each(data, function( index, value ) {
  //             ckUnit += `
  //             <li class="sugget_box_item">
  //             <i class="fas fa-plus"></i>
  //             <a href="/search?q=${value.title}" title="">${value.title}</a>
  //             </li>
  //             `;
  //         });
  //           $('#show_result_search').empty();
  //           $('#show_result_search').append(ckUnit);
  //           $('.search_sugget').show('fast');
  //       }
  //   });
  //   
 function to_slug(str)
{
    // Chuyển hết sang chữ thường
    str = str.toLowerCase();     
 
    // xóa dấu
    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    str = str.replace(/(đ)/g, 'd');
 
    // Xóa ký tự đặc biệt
    str = str.replace(/([^0-9a-z-\s])/g, '');
 
    // Xóa khoảng trắng thay bằng ký tự -
    str = str.replace(/(\s+)/g, '-');
 
    // xóa phần dự - ở đầu
    str = str.replace(/^-+/g, '');
 
    // xóa phần dư - ở cuối
    str = str.replace(/-+$/g, '');
 
    // return
    return str;
}


  