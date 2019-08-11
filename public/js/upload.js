function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        let imageName = input.files[0].name;
        reader.onload = function (e) {
            $('#preview')
                .attr('src', e.target.result)
                .width(150)
                .height(200)
                .attr('alt', imageName)
                .css('display','block')
        };

        reader.readAsDataURL(input.files[0]);
    }
}