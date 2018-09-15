

function LoadDataFromUrlToTable(url, tableId) {

    openApiRequest(url)
        .then(function (data) {

            if (data !== null && data.status === 'ok' | data == "True") {

                $('#overlay').remove();
                $('#'+tableId+'').html(data.content);
            }
        },
        function (error) {
            console.log(error)
        });

};

function openApiRequest(url_, method_ = "GET", dataType_ = "html", data_ = null) {

    let promise = new Promise(function (resolve, reject) {

        let data = {
            status: '',
            content: '',
        };

        let request = $.ajax({
            statusCode: {
                404: function () {
                    reject({
                        status: 'error',
                        content: 'API endpoint error! Please contact administrator.',
                    })
                }
            },
            url: url_,
            method: method_,
            data: data_,
            dataType: dataType_
        });

        request.done(function (data_) {
            resolve({
                status: 'ok',
                content: data_,
            });
        });

        request.fail(function (jqXHR, textStatus) {
            reject({
                status: jqXHR.status,
                content: textStatus,
            })
        });
    });
    return promise
}

/*
* JS to Refresh DataTables
* Ends here. Next Group
*/

//wrapper function for PUT operations

function PutDataToUrl(data, url) {

    return new Promise(resolve => {
        openApiRequest(url, "POST", "json", data_ = data)
            .then(function (data) {
                resolve(data);
            },
            function (error) {
                if(error.status == 500 || error.status == 401)
                {
                    toastr.error("Duplicate.");
                }
            })
    });
}

//end wrapper for PUT functions
//-----------------------------------------------------------------
//wrapper function for DELETE operations

function DeleteDataFromUrl(data, url) {

    return new Promise(resolve => {
        openApiRequest(url, "GET", "json", data_ = data)
            .then(function (data) {
                resolve(data);
            },
            function (error) {
                if(error.status == 500 || error.status == 401)
                {
                    toastr.error("You are about to delete record that in used.");
                }
            })
    });
}

//END for DELETE operations
//-----------------------------------------------------------------
//wrapper function for POST operations

function PostDataToUrl(data,url)
{
    return new Promise((resolve, reject) => {
        openApiRequest(url, "POST", "json", data_ = data)
            .then(function (data) {
                resolve(data);
            },
            function (error) {
                reject(error);
            })
    });
}

//ENDfor POST operations
//-----------------------------------------------------------------
//wrapper function for ajax call


//wrapper function to convert Table to DataTable
//After data population

