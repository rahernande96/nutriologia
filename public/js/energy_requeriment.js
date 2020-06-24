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



if(TYPE_GET == 1){
        
    let kcal_element = document.getElementsByName('kcal')[0];

    let kcal_element_value = kcal_element.value;

}


let supplement_value_element = document.getElementById('supplement_value');
let supplement_value_ = supplement_value_element.value;

supplement_value_element.addEventListener('keyup',function(e){

    supplement_value_ = supplement_value_element.value
    setGet();

});

supplement_value_element.addEventListener('mouseup',function(e){

    supplement_value_ = supplement_value_element.value
    setGet();
});

supplement_value_element.addEventListener('wheel',function(e){

    supplement_value_ = supplement_value_element.value
    setGet();
});


if(TYPE_GET == 1){


    kcal_element.addEventListener('keyup',function(e){

        kcal_element_value = kcal_element.value
        setGet();

    });

    kcal_element.addEventListener('mouseup',function(e){

        kcal_element_value = kcal_element.value
        setGet();

    });

    kcal_element.addEventListener('wheel',function(e){

        kcal_element_value = kcal_element.value
        setGet();

    });

}

function setGet(e){

    if(TYPE_GET == 1){

    if(supplement_value_ == ""){
        supplement_value_ = 0;
    }
    
        document.getElementsByName('get')[0].value = ((kcal_element_value * weight) - supplement_value_ ).toFixed(2);
    } else {

    } 
    calculateCarbohidrates();
    calculateLipids();
    calculateProteins();
}
