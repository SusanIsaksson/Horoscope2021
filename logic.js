window.addEventListener("load", initSite);
document.getElementById("saveBtn").addEventListener("click", saveZodiac);
document.getElementById("getBtn").addEventListener("click", getZodiac);
document.getElementById("updateBtn").addEventListener("click", updateZodiac);
document.getElementById("deleteBtn").addEventListener("click", deleteZodiac);

async function initSite() {
    getZodiac()
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
        alert ("Du måste fylla i ditt födelsedata")
        console.log("Du måste fylla i månad och datum")
        return
    }
    

    const body = new FormData()
    body.set("month", monthInput)
    body.set("day", dayInput)

    console.log(input)

    const calculateZodiac = await makeRequest("./server/addHoroscope.php", "POST", body)
    console.log(calculateZodiac)

    //getZodiac()
}
