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

$(function () {
  showUpdateProfil();
  showBegginerTricks();
  showIntermediateTricks();
  showConfirmedTricks();

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

        $("#editModal").modal("hide");
        $("#edit-form-data")[0].reset();
      },
    });
  });
});
