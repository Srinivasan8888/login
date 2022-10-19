function generatePDF(){
    const element = document.getElementsById("table");

    html2pdf()
    .from(element)
    .save(); 
}