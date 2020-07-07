const mainwidth = 1000
const mainheight = 1000

let dataURItoBlob = dataURI => {
  // convert base64/URLEncoded data component to raw binary data held in a string
  var byteString
  if (dataURI.split(',')[0].indexOf('base64') >= 0)
    byteString = atob(dataURI.split(',')[1])
  else byteString = unescape(dataURI.split(',')[1])

  // separate out the mime component
  var mimeString = dataURI
    .split(',')[0]
    .split(':')[1]
    .split(';')[0]

  // write the bytes of the string to a typed array
  var ia = new Uint8Array(byteString.length)
  for (var i = 0; i < byteString.length; i++) {
    ia[i] = byteString.charCodeAt(i)
  }

  return new Blob([ia], {
    type: mimeString
  })
}

let uploadPicture = () => {
  croppie
    .result({
      size: 'viewport'
    })
    .then(function (dataURI) {
      var formData = new FormData()
      formData.append('design', $('#fg').data('design'))
      formData.append('image', dataURItoBlob(dataURI))
      $.ajax({
        url: 'upload.php',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: response => {
          let res = JSON.parse(response)
          if (res.status) {
            alert(res.message)
            let data = `<a class="btn btn-danger rounded-0" href="${res.data}" download>Download</a>`
            $('#imagedownload').html(data)
          } else {
            alert(res.message)
          }
        },
        error: function () {
          alert('Unable to create image')
          // document.getElementById("download").innerHTML = "Download Profile Picture";
        },
        xhr: function () {
          var myXhr = $.ajaxSettings.xhr()
          if (myXhr.upload) {
            myXhr.upload.addEventListener(
              'progress',
              function (e) {
                if (e.lengthComputable) {
                  var max = e.total
                  var current = e.loaded

                  var percentage = Math.round((current * 100) / max)
                  document.getElementById('download').innerHTML =
                    'Image generated!'
                }
              },
              false
            )
          }
          return myXhr
        }
      })
    })
}

let updatePreview = url => {
  document.getElementById('crop-area').innerHTML = ''
  window.croppie = new Croppie(document.getElementById('crop-area'), {
    url: url,
    boundary: {
      height: mainheight,
      width: mainwidth
    },
    viewport: {
      width: mainwidth,
      height: mainheight
    }
  })

  $('#fg').on('mouseover touchstart', function () {
    document.getElementById('fg').style.zIndex = -1
  })
  $('.cr-boundary').on('mouseleave touchend', function () {
    document.getElementById('fg').style.zIndex = 10
  })

  document.getElementById('download').click = function () {
    this.innerHTML = 'Please wait...'
    uploadPicture(function (r) {
      document.getElementById('download').innerHTML = 'Uploaded'
      window.location = 'download.php?i=' + r
    })
  }
  document.getElementById('download').removeAttribute('disabled')
}

let onFileChange = input => {
  if (input.files && input.files[0]) {
    var reader = new FileReader()

    reader.onload = function (e) {
      image = new Image()
      image.onload = function () {
        var width = this.width
        var height = this.height
        if (width >= mainwidth && height >= mainheight)
          updatePreview(e.target.result)
        else
          alert(
            `Image should be atleast have ${mainwidth}px width and ${mainheight}px height`
          )
      }
      image.src = e.target.result
    }

    reader.readAsDataURL(input.files[0])
  }
  $('#imagedownload').html('')
  $('#download')
    .text('Generate image')
    .show()
}

$(document).ready(function () {
  $('.design').on('click', function () {
    $('#fg')
      .attr('src', $(this).attr('src'))
      .data('design', $(this).data('design'))
    $('.design.active').removeClass('active')
    $(this).addClass('active')
  })
})
$('#download').hide()
