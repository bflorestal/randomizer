$(document).ready(function () {
  // impératif car la page doit être entièrement généré PHP + HTML, tout doit être en place afin que le ciblage des objet soit possible

  // set des variables par défaut
  var nbEleves = 0;
  var nbElevesPromo = 10; // cette valeur aurait pur être récupérée en base de donnée. je l'ai laissée en dur par facilité
  var sliderMouving = "ok";

  //décompte des checkboxs déjà cochées
  function countChecked() {
    nbEleves = $("input:checked").length;
  }

  // Lancement de la fonction précitée
  countChecked();

  function transitionFVJ() {
    // Animation pour faire apparâitre le bouton "Faites vos jeux"
    if (nbEleves > 1) {
      $("#fvj").css({
        "margin-top": "0px",
        opacity: "1",
        display: "block",
        transition: "opacity, 0.5s ease",
      });
    } else {
      $("#fvj").css({
        "margin-top": "-260px",
        opacity: "0",
        transition: "opacity, 0.5s ease",
      });
    }
  }

  // Décompte du nombre de cases cochées / élèves selectionnés
  $(".checkNames").click(function () {
    if ($(this).prop("checked")) {
      nbEleves++;
    } else {
      nbEleves--;
    }
    if (nbEleves <= nbElevesPromo) {
      //
      $("#checkAll").removeAttr("checked"); // On décoche le bouton
      $(".text12").text("CHECK ALL"); // on change simplement le texte dans l'objet / ciblé grâce à sa classe
    }

    transitionFVJ(); // On lance la fonction qui anime dans un sens ou dans l'autre le bouton faites vos jeux
  });

  $("#checkAll").change(function () {
    // A chaque changement de l'état de la checkbox du checkAll
    $("input:checkbox").prop("checked", $(this).prop("checked"));

    if (nbEleves < nbElevesPromo) {
      $(".text12").text("UNCHECK ALL");
      nbEleves = nbElevesPromo;
    } else {
      $(".text12").text("CHECK ALL");
      nbEleves = 0;
    }

    transitionFVJ(); // On lance la fonction qui anime dans un sens ou dans l'autre le bouton faites vos jeux
  });

  //////////////////////////////////// slider photos ///////////////////////////////////////////////////////

  ///////////////Défilement images
  var nbSlide = $("#slot ul li").length - 1; // on compte le nombre de LI
  var i = 0;

  var IntID = setTimer();

  // délais en ms entre chaque déclenchement de l'animation
  function setTimer() {
    j = setInterval(startSlider, 200); // ne pas descendre plus bas en millisecondes, sinon le navigateur se perd et a du mal à stopper l'animation
    return j;
  }

  //arrete le slider si taille ecran inferieur a 600px

  $(window).resize(function () {
    var tailleEcran = $(window).width();
    if (tailleEcran < 600) {
      stopSlider();
      $("#slot ul").removeClass("blur");
    }
  });

  // Arrete le défilement en annulant le temps d'interval.

  function stopSlider() {
    clearInterval(IntID);
  }

  // |||||||||||||||||||||||||||||||||| LE CODE IMPORTANT |||||||||||||||||||||||||||||||||||
  function startSlider() {
    // faire défiler les photos en vertical to top / c'est tout le UL qui bouge

    $("#slot ul").animate({ marginTop: "-240px" }, 200, "linear", function () {
      $(this)
        .css({ marginTop: 0 })
        .find("li:last")
        .after($(this).find("li:first"));
    });
  }

  // Affichage du résultat
  $("#choose").click(function () {
    stopSlider(); // on n'arrête pas l'animation MAIS la fonction qui relance à chaque fois l'animation
    $("#slot ul").removeClass("blur"); // On retire le folou pour distinguer la photo
    $("#slot ul li img").css({
      // l'image devient clicable donc on change le curseur.
      cursor: "pointer",
    });
    sliderMouving = "stop"; // variable pour autoriser ou non l'appel AJAX ci-dessous
  });

  ////////////////////////// AJAX affichage des prénoms //////////////////////////////////////////
  // cette focntionnalité n'est pas pertinente car on pouvait passer le nom différemment dans le PHP. un ALT par exemple, un TITLE d'image, un INPUT TYPE=HIDDEN...
  // c'est juste pour montrer la simplcité de l'ajax, et ne pas rafraichir la page

  // detection evenement sur image uniquement si l'animation va s'arreter
  $("#slot ul li img").click(function () {
    if (sliderMouving == "stop") {
      var value = $(this).attr("id"); // on récupere l'ID de l'élément

      // Envoi des données méthode AJAX au fichier nomEleve.php qui en focntion de l'ID fat une requete qui récupére uneiquement le prénom.
      $.post("nomEleve.php", { id: value }, function (data) {
        $("#slot").html(data); // la valeur de data est en fait ce que le fichier php a généré. Un echo ou un print_r
        $("#slot").addClass("liste-align-centre"); // met le nom au milieu avec un cadre
      });
    }
  });
});
