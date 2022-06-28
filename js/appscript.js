function showUpdateProfil() {
  $.ajax({
    url: "controllers/controller.php",
    type: "POST",
    data: { action: "view" },
    success: function (response) {
      $("#profil_user").html(response);
    },
  });
}

function showBegginerTricks() {
  $.ajax({
    url: "controllers/controller_tricks.php",
    type: "POST",
    data: { action: "viewBegginer" },
    success: function (response) {
      $("#list_trick_begginer").html(response);
    },
  });
}
function showIntermediateTricks() {
  $.ajax({
    url: "controllers/controller_tricks.php",
    type: "POST",
    data: { action: "viewIntermediate" },
    success: function (response) {
      $("#list_trick_intermediate").html(response);
    },
  });
}
function showConfirmedTricks() {
  $.ajax({
    url: "controllers/controller_tricks.php",
    type: "POST",
    data: { action: "viewConfirmed" },
    success: function (response) {
      $("#list_trick_confirmed").html(response);
    },
  });
}
function showExpertTricks() {
  $.ajax({
    url: "controllers/controller_tricks.php",
    type: "POST",
    data: { action: "viewExpert" },
    success: function (response) {
      $("#list_trick_expert").html(response);
    },
  });
}


function showPartiallyTrick() {
  $.ajax({
    url: "controllers/controller_tricks.php",
    type: "POST",
    data: { action: "viewPartially" },
    success: function (response) {
      $(".showPartially").html(response);
    },
  });
}
function showCompletedTricks() {
  $.ajax({
    url: "controllers/controller_tricks.php",
    type: "POST",
    data: { action: "viewCompleted" },
    success: function (response) {
      $(".showCompleted").html(response);
    },
  });
}

$(function () {
  showUpdateProfil();
  showBegginerTricks();
  showIntermediateTricks();
  showConfirmedTricks();
  showExpertTricks();
  // creation d un article requête ajax
  $("#insert").click(function (e) {
    if ($("#form-data")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "controllers/controller.php",
        type: "POST",
        data: $("#form-data").serialize() + "&action=insert",
        success: function (response) {
          console.log(response);
          Swal.fire({ title: "Article ajouté avec succès !", icon: "success" });

          $("#addModal").modal("hide");
          $("#form-data")[0].reset();
          showAllArticles();
        },
      });
    }
  });

  // modification du profil user (Affichage des données dans le modal de modification)
  $("body").on("click", ".editBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");
    $.ajax({
      url: "controllers/controller.php",
      type: "POST",
      data: {
        edit_id: edit_id,
      },
      success: function (response) {
        data = JSON.parse(response);
        $("#edit_id").val(data.id); // à ce niveau data est sous forme de clef:valeur
        $("#country").val(data.country);
        $("#biographie").val(data.biographie);
        $("#skating_since").val(data.skating_since);
        $("#stance").val(data.stance);
        $("#fav_trick").val(data.fav_trick);
      },
    });
  });

  // mis à jour du profil
  $("#update").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "controllers/controller.php",
      type: "POST",
      data: $("#edit-form-data").serialize() + "&action=update",
      success: function (response) {
        Swal.fire({ title: "Profil modifié avec succès !", icon: "success" });

        $("#editModal").modal("hide");
        $("#edit-form-data")[0].reset();
        showUpdateProfil();
      },
    });
  });

  // modification d'un article (récupération de l'id dans le modal de modification)
  $("body").on("click", ".trickBtn", function (e) {
    e.preventDefault();
    trick_id = $(this).attr("id");
    $.ajax({
      url: "controllers/controller_tricks.php",
      type: "POST",
      data: {
        trick_id: trick_id,
        success: function (response) {
          $("#trick_id").val(this.trick_id);
        },
      },
      success: function (response) {
        data = JSON.parse(response);
        console.log(data);
        $("#normal").prop("checked", false);
        $("#fakie").prop("checked", false);
        $("#switch").prop("checked", false);
        $("#nollie").prop("checked", false);

        if (data[0]) {
          switch (data[0].libelle_stance) {
            case "normal":
              $("#normal").prop("checked", true);
              break;
            case "fakie":
              $("#fakie").prop("checked", true);
              break;
            case "switch":
              $("#switch").prop("checked", true);
              break;
            case "nollie":
              $("#nollie").prop("checked", true);
              break;
            default:
              console.log(`Sorry, we are out of stance`);
          }
        }
        if (data[1]) {
          switch (data[1].libelle_stance) {
            case "normal":
              $("#normal").prop("checked", true);
              break;
            case "fakie":
              $("#fakie").prop("checked", true);
              break;
            case "switch":
              $("#switch").prop("checked", true);
              break;
            case "nollie":
              $("#nollie").prop("checked", true);
              break;
            default:
              console.log(`Sorry, we are out of stance`);
          }
        }
        if (data[2]) {
          switch (data[2].libelle_stance) {
            case "normal":
              $("#normal").prop("checked", true);
              break;
            case "fakie":
              $("#fakie").prop("checked", true);
              break;
            case "switch":
              $("#switch").prop("checked", true);
              break;
            case "nollie":
              $("#nollie").prop("checked", true);
              break;
            default:
              console.log(`Sorry, we are out of stance`);
          }
        }
        if (data[3]) {
          switch (data[3].libelle_stance) {
            case "normal":
              $("#normal").prop("checked", true);
              break;
            case "fakie":
              $("#fakie").prop("checked", true);
              break;
            case "switch":
              $("#switch").prop("checked", true);
              break;
            case "nollie":
              $("#nollie").prop("checked", true);
              break;
            default:
              console.log(`Sorry, we are out of stance`);
          }
        }
      },
    });
  });
  // Ajout d'un trick a la bdd
  $("#addTrick").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "controllers/controller_tricks.php",
      type: "POST",
      data: $("#edit-form-data").serialize() + "&action=update",
      success: function (response) {
        Swal.fire({ title: "Trick ajouté avec succès !", icon: "success" });
        showBegginerTricks();
        showConfirmedTricks();
        showIntermediateTricks();
        showExpertTricks();

        if ($(".showPartially").html() != "") {
          showPartiallyTrick();
          $(".showCompleted").html("");
        }
        if ($(".showCompleted").html() != "") {
          showCompletedTricks();
          $(".showPartially").html("");
        }
        $("#editModal").modal("hide");
        $("#edit-form-data")[0].reset();
      },
    });
  });

  $("#showPartially").click(function (e) {
    showPartiallyTrick();
    $(".showCompleted").html("");
    $("#accordion").html("");
  });
  $("#showCompleted").click(function (e) {
    showCompletedTricks();
    $(".showPartially").html("");
    $("#accordion").html("");
  });
  $("#reset").click(function (e) {
    $(".reset").html("");
    $("#accordion").html(
      ' <div class="card begginer"> <div class="card-header" id="headingOne"> <h5 class="mb-0"> <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Beginner tricks </button> </h5> </div><div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion"> <div class="card-body table-responsive "> <table class="table table-striped"> <thead> <tr> <th scope="col-2">Name trick</th> <th scope="col-1">Stars</th> <th scope="col-2">Actions</th> <th scope="col-1">Partially completed</th> <th scope="col-1">100% Completed</th> </tr></thead> <tbody id="list_trick_begginer"> </tbody> </table> </div></div></div><div class="card intermediate"> <div class="card-header" id="headingTwo"> <h5 class="mb-0"> <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Intermediaire tricks </button> </h5> </div><div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion"> <div class="card-body table-responsive"> <table class="table table-striped"> <thead> <tr> <th scope="col">Name trick</th> <th scope="col">Stars</th> <th scope="col">Actions</th> <th scope="col">Partially completed</th> <th scope="col">100% Completed</th> </tr></thead> <tbody id="list_trick_intermediate"> </tbody> </table> </div></div></div><div class="card confirmed"> <div class="card-header" id="headingThree"> <h5 class="mb-0"> <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> Confirmed tricks </button> </h5> </div><div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion"> <div class="card-body table-responsive"> <table class="table table-striped"> <thead> <tr> <th scope="col">Name trick</th> <th scope="col">Stars</th> <th scope="col">Actions</th> <th scope="col">Partially completed</th> <th scope="col">100% Completed</th> </tr></thead> <tbody id="list_trick_confirmed"> </tbody> </table> </div></div></div><div class="card expert"> <div class="card-header" id="headingFour"> <h5 class="mb-0"> <button class="btn collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> Expert tricks </button> </h5> </div><div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion"> <div class="card-body table-responsive"> <table class="table table-striped"> <thead> <tr> <th scope="col">Name trick</th> <th scope="col">Stars</th> <th scope="col">Actions</th> <th scope="col">Partially completed</th> <th scope="col">100% Completed</th> </tr></thead> <tbody id="list_trick_expert"> </tbody> </table> </div></div></div></div>'
    );
    showBegginerTricks();
    showConfirmedTricks();
    showIntermediateTricks();
    showExpertTricks();
  });
});
