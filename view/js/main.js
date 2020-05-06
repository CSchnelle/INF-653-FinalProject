
const resetQuoteListForm = () => {
    //reset menus
    const selectMenuOptions = document.querySelectorAll("#quote_selection select option");
    selectMenuOptions.forEach(option => {
        if (option.text == "View All Authors" || 
            option.text == "View All Categories" || 
            option.text == "View All Quotes") {
                option.selected = true;
                option.defaultSelected = true;
        } else {
            option.selected = false;
            option.defaultSelected = false;
        }
    });
    //reset radio buttons
    document.getElementById("sortByCategoryID").checked = true;
    document.getElementById("sortByAuthorID").defaultChecked = true;
}

const init = () => {
    document.getElementById("resetQuoteListForm").addEventListener("click", resetQuoteListForm);
}


init();