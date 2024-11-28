// ----------------------
// Lazy Load init
// -----------------------
var start = 0;
var limit = 30;
function make_zero() {
    start = 0;
    limit = 30;
};

// STUDENT SECTION

/* -------------------------------
    Notes
    -------------------------------- */

// Notes Load
$("#student-notes-loading-btn").click(function () {
    $("#student-notes-loading-btn").hide();
    $("#student-notes-loading").show();
    studentNotesLoad();
});

function studentNotesLoad() {
    $.ajax({
        url: "include/student_notes_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#student-notes-loading-btn").show();
            $("#student-notes-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#student-notes-loading-btn").show();
                $("#student-notes-loading").hide();
                if (start == 0) {
                    $("#student-notes-loading-btn").html("No data found");
                } else {
                    $("#student-notes-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#student-notes-loading-btn").html("Load more").show();
                $("#student-notes-loading").hide();
                $("#student-notes-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}

// Notes search
$("#student-notes-search").click(function () {
    var searchData = $("#search").val();
    if (searchData.length < 2) {
        alert("Please enter atleast 2 charcaters..")
    } else {
        $("#student-notes-loading-btn").hide();
        $("#student-notes-loading").show();
        $.ajax({
            url: "include/student_notes_search.php",
            method: "POST",
            dataType: "text",
            cache: false,
            data: { search_data: searchData },
            error: function () {
                alert("Failed!");
                $("#student-notes-loading-btn").show();
                $("#student-notes-loading").hide();
            },
            success: function (response) {
                if (!$.trim(response)) {
                    $("#student-notes-loading-btn").show();
                    $("#student-notes-loading").hide();
                    $("#student-notes-table-data-body").html(response);
                    $("#student-notes-loading-btn").html("No data found, Click to load all data");
                    make_zero(); // Reset Start and Limit
                } else {
                    start += limit;
                    $("#student-notes-loading-btn").hide();
                    $("#student-notes-loading").hide();
                    $("#student-notes-table-data-body").html(response);
                }
            },
            timeout: 8000,
        });
    }
});

// Notes Mark Downloaded
$(document).on("click", "#download-btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to mark download ?")) {
        $.ajax({
            url: "include/notes_mark_download.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                window.location.reload();
            },
            timeout: 8000,
        });
    }
});



/* -------------------------------
    Lab 
    -------------------------------- */
// Lab load
$("#student-lab-loading-btn").click(function () {
    $("#student-lab-loading-btn").hide();
    $("#student-lab-loading").show();
    studentLabLoad();
});

function studentLabLoad() {
    $.ajax({
        url: "include/student_lab_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#student-lab-loading-btn").show();
            $("#student-lab-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#student-lab-loading-btn").show();
                $("#student-lab-loading").hide();
                if (start == 0) {
                    $("#student-lab-loading-btn").html("No data found");
                } else {
                    $("#student-lab-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#student-lab-loading-btn").html("Load more").show();
                $("#student-lab-loading").hide();
                $("#student-lab-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}



// ADMIN SECTION

/* -------------------------------
    Dashboard
    -------------------------------- */
// Students Chart Load
function studentsChartLoad() {
    $.ajax({
        url: "include/students_chart_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        error: function () {
            alert("Failed!");
        },
        success: function (response) {
            if (response) {
                studentOptions.data[0].dataPoints = JSON.parse(response);
                $("#studentsContainer").CanvasJSChart(studentOptions);
            }
        },
        timeout: 8000,
    });
}


/* -------------------------------
    Entries
    -------------------------------- */
// Entries load dashbaord
$("#entries-form-loading-btn").click(function () {
    $("#entries-form-loading-btn").hide();
    $("#entries-form-loading").show();
    entriesFormLoad();
});

function entriesFormLoad() {
    $.ajax({
        url: "include/entries_form_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#entries-form-loading-btn").show();
            $("#entries-form-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#entries-form-loading-btn").show();
                $("#entries-form-loading").hide();
                if (start == 0) {
                    $("#entries-form-loading-btn").html("No data found");
                } else {
                    $("#entries-form-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#entries-form-loading-btn").html("Load more").show();
                $("#entries-form-loading").hide();
                $("#entries-form-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}





/* -------------------------------
    USER 
    -------------------------------- */
// User load
$("#user-loading-btn").click(function () {
    $("#user-loading-btn").hide();
    $("#user-loading").show();
    userLoad();
});

function userLoad() {
    $.ajax({
        url: "include/user_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#user-loading-btn").show();
            $("#user-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#user-loading-btn").show();
                $("#user-loading").hide();
                if (start == 0) {
                    $("#user-loading-btn").html("No data found");
                } else {
                    $("#user-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#user-loading-btn").html("Load more").show();
                $("#user-loading").hide();
                $("#user-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}

// // User search
$("#user-search").click(function () {
    var searchData = $("#search").val();
    if (searchData.length < 3) {
        alert("Please enter atleast 3 charcaters..")
    } else {
        $("#user-loading-btn").hide();
        $("#user-loading").show();
        $.ajax({
            url: "include/user_search.php",
            method: "POST",
            dataType: "text",
            cache: false,
            data: { search_data: searchData },
            error: function () {
                alert("Failed!");
                $("#user-loading-btn").show();
                $("#user-loading").hide();
            },
            success: function (response) {
                if (!$.trim(response)) {
                    $("#user-loading-btn").show();
                    $("#user-loading").hide();
                    $("#user-table-data-body").html(response);
                    $("#user-loading-btn").html("No data found, Click to load all data");
                    make_zero(); // Reset Start and Limit
                } else {
                    start += limit;
                    $("#user-loading-btn").hide();
                    $("#user-loading").hide();
                    $("#user-table-data-body").html(response);
                }
            },
            timeout: 8000,
        });
    }
});

// User delete
$(document).on("click", "#user_data_remove_btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to delete this record ?")) {
        $.ajax({
            url: "include/user_delete.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                $(".alert-area").html(data);
            },
            timeout: 8000,
        });
    }
});



// User verify
$(document).on("click", "#verify-btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to verify this user ?")) {
        $.ajax({
            url: "include/user_verify.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                window.location.reload();
            },
            timeout: 8000,
        });
    }
});


/* -------------------------------
    Notes 
    -------------------------------- */
// Notes load
$("#notes-loading-btn").click(function () {
    $("#notes-loading-btn").hide();
    $("#notes-loading").show();
    notesLoad();
});

function notesLoad() {
    $.ajax({
        url: "include/notes_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#notes-loading-btn").show();
            $("#notes-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#notes-loading-btn").show();
                $("#notes-loading").hide();
                if (start == 0) {
                    $("#notes-loading-btn").html("No data found");
                } else {
                    $("#notes-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#notes-loading-btn").html("Load more").show();
                $("#notes-loading").hide();
                $("#notes-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}

// Notes search
$("#notes-search").click(function () {
    var searchData = $("#search").val();
    if (searchData.length < 2) {
        alert("Please enter atleast 2 charcaters..")
    } else {
        $("#notes-loading-btn").hide();
        $("#notes-loading").show();
        $.ajax({
            url: "include/notes_search.php",
            method: "POST",
            dataType: "text",
            cache: false,
            data: { search_data: searchData },
            error: function () {
                alert("Failed!");
                $("#notes-loading-btn").show();
                $("#notes-loading").hide();
            },
            success: function (response) {
                if (!$.trim(response)) {
                    $("#notes-loading-btn").show();
                    $("#notes-loading").hide();
                    $("#notes-table-data-body").html(response);
                    $("#notes-loading-btn").html("No data found, Click to load all data");
                    make_zero(); // Reset Start and Limit
                } else {
                    start += limit;
                    $("#notes-loading-btn").hide();
                    $("#notes-loading").hide();
                    $("#notes-table-data-body").html(response);
                }
            },
            timeout: 8000,
        });
    }
});

// Notes delete
$(document).on("click", "#notes_data_remove_btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to delete this record ?")) {
        $.ajax({
            url: "include/notes_delete.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                $(".alert-area").html(data);
            },
            timeout: 8000,
        });
    }
});


/* -------------------------------
    Lab 
    -------------------------------- */
// Lab load
$("#lab-loading-btn").click(function () {
    $("#lab-loading-btn").hide();
    $("#lab-loading").show();
    labLoad();
});

function labLoad() {
    $.ajax({
        url: "include/lab_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#lab-loading-btn").show();
            $("#lab-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#lab-loading-btn").show();
                $("#lab-loading").hide();
                if (start == 0) {
                    $("#lab-loading-btn").html("No data found");
                } else {
                    $("#lab-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#lab-loading-btn").html("Load more").show();
                $("#lab-loading").hide();
                $("#lab-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}

// Lab search
$("#lab-search").click(function () {
    var searchData = $("#search").val();
    if (searchData.length < 2) {
        alert("Please enter atleast 2 charcaters..")
    } else {
        $("#lab-loading-btn").hide();
        $("#lab-loading").show();
        $.ajax({
            url: "include/lab_search.php",
            method: "POST",
            dataType: "text",
            cache: false,
            data: { search_data: searchData },
            error: function () {
                alert("Failed!");
                $("#lab-loading-btn").show();
                $("#lab-loading").hide();
            },
            success: function (response) {
                if (!$.trim(response)) {
                    $("#lab-loading-btn").show();
                    $("#lab-loading").hide();
                    $("#lab-table-data-body").html(response);
                    $("#lab-loading-btn").html("No data found, Click to load all data");
                    make_zero(); // Reset Start and Limit
                } else {
                    start += limit;
                    $("#lab-loading-btn").hide();
                    $("#lab-loading").hide();
                    $("#lab-table-data-body").html(response);
                }
            },
            timeout: 8000,
        });
    }
});

// lab delete
$(document).on("click", "#lab_data_remove_btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to delete this record ?")) {
        $.ajax({
            url: "include/lab_delete.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                $(".alert-area").html(data);
            },
            timeout: 8000,
        });
    }
});



/* -------------------------------
    reports
    -------------------------------- */
// reports load dashbaord
$("#reports-loading-btn").click(function () {
    $("#reports-loading-btn").hide();
    $("#reports-loading").show();
    reportsFormLoad();
});

function reportsFormLoad() {
    $.ajax({
        url: "include/entries_form_load.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { start: start, limit: limit },
        error: function () {
            alert("Failed!, Please try again");
            $("#reports-loading-btn").show();
            $("#reports-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#reports-loading-btn").show();
                $("#reports-loading").hide();
                if (start == 0) {
                    $("#reports-loading-btn").html("No data found");
                } else {
                    $("#reports-loading-btn").html("No more data found");
                }
            } else {
                start += limit;
                $("#reports-loading-btn").html("Load more").show();
                $("#reports-loading").hide();
                $("#reports-table-data-body").append(response);
            }
        },
        timeout: 8000,
    });
}

// Change attendance
$(document).on("click", "#change-attendance-btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to update this attendance ?")) {
        $.ajax({
            url: "include/change_attendance.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                window.location.reload();
            },
            timeout: 8000,
        });
    }
});

// Reports delete
$(document).on("click", "#entries_data_remove_btn", function (event) {
    var id = $(this).parents("tr").attr("id");
    if (confirm("Are you sure to delete this record ?")) {
        $.ajax({
            url: "include/entries_delete.php",
            type: "POST",
            data: { id: id },
            error: function () {
                alert("Failed!");
            },
            success: function (data) {
                $(".alert-area").html(data);
            },
            timeout: 8000,
        });
    }
});

$("#filter-reports-btn").click(function () {
    $("#reports-loading-btn").hide();
    $("#reports-loading").show();
    reportsFilterLoad();
    reportsGraphFilterLoad($("#year").val());
});
// Reports filter
function reportsFilterLoad () {
    var yearFilter = $("#year").val();
    var monthFilter = $("#month").val();
    $("#reports-loading-btn").hide();
    $("#reports-loading").show();
    $.ajax({
        url: "include/reports_filter.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { year : yearFilter, month : monthFilter },
        error: function () {
            alert("Failed!");
            $("#reports-loading-btn").show();
            $("#reports-loading").hide();
        },
        success: function (response) {
            if (!$.trim(response)) {
                $("#reports-loading-btn").show();
                $("#reports-loading").hide();
                $("#reports-table-data-body").html(response);
                $("#reports-loading-btn").html("No data found, Click to load all data");
                    make_zero(); // Reset Start and Limit
                } else {
                    start += limit;
                    $("#reports-loading-btn").hide();
                    $("#reports-loading").hide();
                    $("#reports-table-data-body").html(response);
                }
            },
            timeout: 8000,
        });
}

// Reports Graph Filter
function reportsGraphFilterLoad (year) {
    var yearFilter = year;
    $("#reports-loading-btn").hide();
    $("#reports-loading").show();
    $.ajax({
        url: "include/reports_graph_filter.php",
        method: "POST",
        dataType: "text",
        cache: false,
        data: { year : yearFilter},
        error: function () {
            alert("Failed!");
            $("#reports-loading-btn").show();
            $("#reports-loading").hide();
        },
        success: function (response) {
            $("#reports-loading-btn").hide();
            $("#reports-loading").hide();
            if (response) {
                entriesGraph.data[0].dataPoints = JSON.parse(response);
                $("#entriesGraph").CanvasJSChart(entriesGraph);
            }
        },
        timeout: 8000,
    });
}

// Reports search
$("#reports-search").click(function () {
    var searchData = $("#search").val();
    if (searchData.length < 2) {
        alert("Please enter atleast 2 charcaters..")
    } else {
        $("#reports-loading-btn").hide();
        $("#reports-loading").show();
        $.ajax({
            url: "include/reports_search.php",
            method: "POST",
            dataType: "text",
            cache: false,
            data: { search_data: searchData },
            error: function () {
                alert("Failed!");
                $("#reports-loading-btn").show();
                $("#reports-loading").hide();
            },
            success: function (response) {
                if (!$.trim(response)) {
                    $("#reports-loading-btn").show();
                    $("#reports-loading").hide();
                    $("#reports-table-data-body").html(response);
                    $("#reports-loading-btn").html("No data found, Click to load all data");
                    make_zero(); // Reset Start and Limit
                } else {
                    start += limit;
                    $("#reports-loading-btn").hide();
                    $("#reports-loading").hide();
                    $("#reports-table-data-body").html(response);
                }
            },
            timeout: 8000,
        });
    }
});

// Send Otp
$(".otp-btn").click(function () {
    var email = $("#email").val();
    var sendButton = $(this);
    sendButton.html('<img src="./images/loader.svg" />Sending...');
    if (!validateEmail(email)) {
        alert("Enter Valid Email");
        sendButton.html('Send OTP');
    } else {
        $.ajax({
            url: "include/send_otp.php",
            method: "POST",
            dataType: "text",
            cache: false,
            data: { otpEmail: email },
            error: function () {
                sendButton.html('Send OTP');
                alert("Failed! Try after some time");
            },
            success: function (response) {
                if(JSON.parse(response).code == "0"){
                    sendButton.html('Send OTP');
                    alert(JSON.parse(response).msg);
                }else if(JSON.parse(response).code == "1"){
                    alert(JSON.parse(response).msg);
                    sendButton.html("Resend OTP");
                }
            },
            timeout: 8000,
        });
    }
});

function validateEmail(email) {
    // Regular expression for a valid email address
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Test the email against the regex
    return emailRegex.test(email);
}
