window.addEventListener("load", initSite);

document.getElementById("saveBtn").addEventListener("click", saveZodiac);
document.getElementById("updateBtn").addEventListener("click", updateZodiac);
document.getElementById("deleteBtn").addEventListener("click", deleteZodiac);


async function initSite() {
    document.getElementById("yourZodiac").innerText = "";
    //getZodiac()
  
}

//POST
async function saveZodiac() {

    
    let monthInput
    let dayInput
    
    const input = document.getElementById("dateInput").value;
    const birthday = new Date(input);
    if (!!birthday.valueOf()) {
        monthInput = birthday.getMonth() + 1;
        dayInput = birthday.getDate();
    }
    if (!input.length) {
        alert ("Du måste fylla i ett födelsedatum")
        console.log(false)
        return
    }
    

    const body = new FormData()
    body.set("month", monthInput)
    body.set("day", dayInput)

    console.log(true)
    document.getElementById("resultDate").innerText = "Du har valt datum: " + dayInput + " / " + monthInput;
    //document.getElementById("dateInput").value = "";
    

    const calculateZodiac = await makeRequest("./server/addHoroscope.php", "POST", body)
    console.log(calculateZodiac)
    
    getZodiac();
}

//GET (viewHoroscope)
async function getZodiac() {

    const zodiacInput = document.getElementById("yourZodiac")
    const collectedZodiac = await makeRequest("./server/viewHoroscope.php", "GET")

    console.log(collectedZodiac)
    
    zodiacInput.innerText = "Ditt stjärntecken är: " + collectedZodiac;
    

}

//POST 
async function updateZodiac() {

    let monthInput
    let dayInput

    const input = document.getElementById("dateInput").value;
    const birthday = new Date(input);
    if (!!birthday.valueOf()) {
        monthInput = birthday.getMonth() + 1;
        dayInput = birthday.getDate();
    }
    if (!input.length) {
        alert ("Du måste fylla i ditt födelsedata")
        console.log("false")
        return
    }
    
    const body = new FormData()
    body.set("month", monthInput)
    body.set("day", dayInput)

    const collectedZodiac = await makeRequest("./server/updateHoroscope.php", "POST", body)
    console.log(collectedZodiac)
    getZodiac()
}

//DELETE
async function deleteZodiac() {
    const collectedZodiac = await makeRequest("./server/deleteHoroscope.php", "DELETE")

    console.log(collectedZodiac)
    getZodiac()
}



async function makeRequest(path, method, body) {
    try {
        const response = await fetch(path, {
            method,
            body
        })
        console.log(response)
        return response.json()

    } catch(err) {
        console.log("Fel vid fetch", err)
    }
}
