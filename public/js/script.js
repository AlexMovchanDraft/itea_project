const getrandom = () => {
    var random_string = Math.random().toString(32).substring(2, 5) + Math.random().toString(32).substring(2, 5);
    return random_string;
}

const validateURL= () => {
    const url = $('#link-coder').val();

    var protocol_ok = url.startsWith("http://") || url.startsWith("https://") || url.startsWith("ftp://");
    if(!protocol_ok){
        newurl = "http://"+url;
        return newurl;
    }else{
        return url;
    }
};


let convertLink = () => {
    const original = validateURL();
    const encoded = getrandom();
    const data = { original: original, encoded: encoded };

    $.ajax({
        url:        '/link/add_link',
        type:       'POST',
        dataType:   'json',
        async:      true,
        data:       data,

        success: function(data, status) {
            console.log('success - ', data);
            $('#encoded-link').attr("href", `http://127.0.0.1:8000/link/${data.encoded}`).html(`http://127.0.0.1:8000/link/${data.encoded}`);
        },

        error : function(error, text, lol) {
            alert(error.responseJSON);
            // alert(`Ajax request failed. ${textStatus} ${errorThrown}`);
        }
    });
};



