const button = document.getElementById("ButtonSubmit");
button.addEventListener("click",collectData);

function next(){

}

async function collectData() {
    const inputcode= document.getElementById("input-code").value;
    const inputValue= document.getElementById("input-Value").value;
    const inputCustomername= document.getElementById("input-Customername").value;
    const inputEmail= document.getElementById("input-Email").value;

    if(inputcode.length > 10){
        google.script.run.errorValidateCode('Code phải Nhập 10 ký tự');
        return;
    }
    var a = google.script.run.withSuccessHandler(function(res){
        return res;
    }).isExistColunmA();
    console.log("a", a);

    google.script.run.withSuccessHandler(function(res){
        console.log("re", res);
        if(inputcode.length == 0 || inputValue.length == 0 || inputCustomername.length == 0 || inputEmail.length == 0 )     {
            google.script.run.errMessage();
        } else {
            const data = {
                code: inputcode,
                value: inputValue,
                customername: inputCustomername,
                email: inputEmail
            }


            google.script.run.appendData(data);
            inputcode = "";
            inputValue = "";
            inputCustomername = "";
            inputEmail = ""
        }).isExistColunm(inputcode, 0)

    });
        google.script.run.withFailureHandler(function(res){
            console.log("re", res);

        });

}
