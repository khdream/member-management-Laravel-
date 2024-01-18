$(document).ready(function () {
    var isNew = false;
    var memberId = 0;
    var deleteMemberId = false;

    // $("#deleteConfirm").click(function () {
    //     $.ajax({
    //         url: `/members/${deleteMemberId}`,
    //         method: "DELETE",
    //         data: { id: deleteMemberId },
    //         headers: {
    //             "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
    //         },
    //         success: function (response) {
    //             $("#deleteCancelButton").click();
    //             // $("#toastmember").addClass("text-bg-success");
    //             // $("#toastmember").show();
    //             // $("#toastValue").text("削除が正常に完了しました。");
    //             // setTimeout(function () {
    //             //     $("#toastmember").hide();
    //             // }, 2000);
    //             location.reload();
    //         },
    //         error: function (xhr, status, error) {
    //             console.log("error");
    //         },
    //     });
    // });

    $("#addDestinationButton").click(function () {
        isCreate = false;
        $("#clientId").val("");
        $("#destinationName").val("");
        $("#adressName").val("");
        $("#locationName").val("");
        $("#post_code_suffix").val("");

        $("#clientId_Error").text("");
        $("#destinationName_Error").text("");
        $("#adressName_Error").text("");
        $("#locationName_Error").text("");
        $("#post_code_suffix_Error").text("");
    });
    $("#addAndEditDestinationConfirmButton").click(function () {
        var errors = validateForm();

        if (Object.keys(errors).length > 0) {
            validationHandle(errors);
        } else {
            if (isCreate) {
                $.ajax({
                    url: `/members/${memberId}`,
                    method: "PUT",
                    data: $("#myForm").serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr(
                            "content"
                        ),
                    },
                    success: function (res, status) {
                        if (status == "success" && res.message == "success") {
                            $("#cancelButton").click();
                            location.reload();
                        } else {
                            console.log("error");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("error");
                    },
                });
            } else {
                $.ajax({
                    url: "/destination",
                    method: "POST",
                    data: $("#newDestinationForm").serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr(
                            "content"
                        ),
                    },
                    success: function (res, status) {
                        console.log(res.users);
                        if (status == "success" && res.message == "success") {
                            $("#cancelButton").click();
                            // location.reload();
                            location.href = "/destination";
                        } else {
                            console.log("error");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("error");
                    },
                });
            }
        }
    });
    $(".editButton").click(function (event) {
        const id = this.getAttribute("memberId");
        isCreate = true;
        memberId = id;

        $("#company_name").val($("#company_name_" + id).text());
        $("#name").val($("#name_" + id).text());
        $("#furigana_name").val($("#furigana_name_" + id).text());
        $("#email").val($("#email_" + id).text());
        // $("#password").val($("#password_" + id).text());
        $("#phone_number").val($("#phone_number_" + id).text());
        $("#post_code_prefix").val(
            $("#post_code_" + id)
                .text()
                .slice(0, 3)
        );
        $("#post_code_suffix").val(
            $("#post_code_" + id)
                .text()
                .slice(4, 8)
        );
        $("#location").val($("#location_" + id).text());
        $("#street_adress").val($("#street_adress_" + id).text());
        $("#building_name").val($("#building_name_" + id).text());
    });
    $(".deleteButton").click(function (event) {
        const id = this.getAttribute("memberId");
        deleteMemberId = id;
    });
    $("#search_field").on("input", function () {
        var value = $(this).val().toLowerCase();
        $("#searchButton").attr("href", "/members?value=" + value);
    });

    function validateForm() {
        // Get input field values
        var clientId = $("#clientId").val();
        var destinationName = $("#destinationName").val();
        var adressName = $("#adressName").val();
        var locationName = $("#locationName").val();
        var post_code_suffix = $("#post_code_suffix").val();

        // Initialize an errors object
        var errors = {};

        if (clientId.trim() === "") {
            errors.clientId = "管理IDは必須です。";
        }
        if (destinationName.trim() === "") {
            errors.destinationName = "配送先の名前は必須です。";
        }
        if (post_code_suffix.trim() === "") {
            errors.post_code_suffix = "郵便番号のエントリは必須です。";
        } else if (post_code_suffix.length !== 4) {
            errors.post_code_suffix = "郵便番号を正確に入力してください。";
        }
        if (adressName.trim() === "") {
            errors.adressName = "住所項目フィールドは必須です。";
        }
        if (locationName.trim() === "") {
            errors.locationName = "番地項目フィールドは必須です。";
        }
        return errors;
    }

    function validationHandle(errors) {
        for (var fieldName in errors) {
            if (errors.hasOwnProperty(fieldName)) {
                var errorMessage = errors[fieldName];
                var errorElement = $("#" + fieldName + "_Error");
                errorElement.text(errorMessage);
                errorElement.show();
            }
        }
        setTimeout(function () {
            for (var fieldName in errors) {
                if (errors.hasOwnProperty(fieldName)) {
                    var errorElement = $("#" + fieldName + "_Error");
                    errorElement.hide();
                }
            }
        }, 5000);
    }

    // Handle form submission
});
