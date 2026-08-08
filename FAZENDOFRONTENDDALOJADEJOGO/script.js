const slides = document.querySelector(".slides");

const indicadores = document.querySelectorAll(".indicador");

let atual = 0;

function mostrarSlide(indice){

    slides.style.transform = `translateX(-${indice * 100}%)`;

    indicadores.forEach((item)=>{

        item.classList.remove("ativo");

    });

    indicadores[indice].classList.add("ativo");

    atual = indice;

}

setInterval(()=>{

    atual++;

    if(atual >= indicadores.length){

        atual = 0;

    }

    mostrarSlide(atual);

},4000);

indicadores.forEach((item,indice)=>{

    item.addEventListener("click",()=>{

        mostrarSlide(indice);

    });

});

const perguntas = document.querySelectorAll(".faq-item");

perguntas.forEach((item) => {

    const botao = item.querySelector(".faq-pergunta");

    botao.addEventListener("click", () => {

        perguntas.forEach((faq) => {
            if (faq !== item) {
                faq.classList.remove("ativo");
            }
        });

        item.classList.toggle("ativo");

    });

});