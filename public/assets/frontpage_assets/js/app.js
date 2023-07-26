
/**
 * Js for Accordion
 */
const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

accordionItemHeaders.forEach(accordionItemHeader => {
    accordionItemHeader.addEventListener("click", event => {

        accordionItemHeader.classList.toggle("active");

        const accordionItemBody = accordionItemHeader.nextElementSibling;

        if(accordionItemHeader.classList.contains("active")) {
            accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
        }
        else {
            accordionItemBody.style.maxHeight = 0;
        }
        
    });
});

/**
 * show password
 */

const eye = document.getElementById("eye");
const password = document.getElementById("password")

eye.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
    }else {
        password.type = "password"
    }
}