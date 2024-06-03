/*
 
Welcome to your app's main JavaScript file!*
We recommend including the built version of this JavaScript file
(and its CSS file) in your base layout (base.html.twig).
*/

// any CSS you import will output into a single css file (app.css in this case)
//import './styles/app.css';


import * as bootstrap from 'bootstrap';

document.addEventListener('DOMContentLoaded', function(event){

    let addToCartButton = document.getElementsByClassName('add-to-cart');
    console.log(addToCartButton)

    Array.from(addToCartButton).forEach(function(element){
        console.log(element)
        element.addEventListener('click', function(event){
            event.preventDefault();
            let elementId =  event.target.id;
            let id = elementId.replace('product-','');
            addToCart(id);
        })
    }) 
})


let addToCart = function(id){
let url = "/xhr/cart/add/";
let xhr = new XMLHttpRequest();

xhr.open('GET', url+id);
xhr.send();


//requête passée, traitement du retour serveur (Si 4xx et 5xx ça arrive ici)
xhr.onload = function(){
  if(xhr.status==200){
    //tout ok
  }else{
    alert(xhr.status+' '+xhr.responseText)
  }
};

//requête pas passée
xhr.onerror = function(){
    alert('XHR Error')
};

//requête
xhr.onprogress = function(){

};

}