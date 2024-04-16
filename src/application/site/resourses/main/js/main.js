function cloneDOM(selector) {
    return $(selector).clone(true, true);
}

function sendForm(
    method,
    url,
    contentType,
    responseType,
    body
) {
    var sendForm = new XMLHttpRequest();

    sendForm.open(method, url);
    sendForm.setRequestHeader('Content-Type', contentType);
    sendForm.responseType = responseType;
    sendForm.send(body);

    return sendForm;
}
