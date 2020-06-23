const gr_Hc = 4;
const gr_Lp = 9;
const gr_Pt = 4;

let elementPercentageHC = document.getElementsByName('percentage_carbohydrates')[0];

function calculateCarbohidrates(){

    let percentage = elementPercentageHC.value;

    document.getElementById('carboHidratesValue').innerText = ((percentage * document.getElementsByName('get')[0].value)/100).toFixed(2);
    
    document.getElementById('carboHidratesValueGr').innerText = (((percentage * document.getElementsByName('get')[0].value)/100)/gr_Hc).toFixed(2);
    
    document.getElementById('carboHidratesValueGrKg').innerText = ((((percentage * document.getElementsByName('get')[0].value)/100)/gr_Hc)/weight).toFixed(2);


}


let elementPercentageLP = document.getElementsByName('percentage_lipids')[0];

function calculateLipids(){

    let percentage = elementPercentageLP.value;

    document.getElementById('lipidsValue').innerText = ((percentage * document.getElementsByName('get')[0].value)/100).toFixed(2);
    
    document.getElementById('lipidsValueGr').innerText = (((percentage * document.getElementsByName('get')[0].value)/100)/gr_Lp).toFixed(2);
    
    document.getElementById('lipidsValueGrKg').innerText = ( (((percentage * document.getElementsByName('get')[0].value)/100)/gr_Lp)/weight ).toFixed(2);


}

let elementPercentagePT = document.getElementsByName('percentage_protein')[0];

function calculateProteins(){

    let percentage = elementPercentagePT.value;

    document.getElementById('proteinValue').innerText = ((percentage * document.getElementsByName('get')[0].value)/100).toFixed(2);
    
    document.getElementById('proteinValueGr').innerText = (( weight * document.getElementsByName('gr_kg_proteins')[0].value ) * gr_Pt ).toFixed(2);

}

document.getElementsByName('gr_kg_proteins')[0].addEventListener('keyup',function(){

    calculateProteins();

});
document.getElementsByName('gr_kg_proteins')[0].addEventListener('mouseup',function(){

    calculateProteins();

});
document.getElementsByName('gr_kg_proteins')[0].addEventListener('wheel',function(){

    calculateProteins();

});
