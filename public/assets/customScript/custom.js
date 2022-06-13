const URL= "http://localhost:8090";

// export interface CoreFetch {
//   url: string;
//   method: string;
//   data?: object;
//   headers?: object;
//   otherOptions?: objOptions;
//   cbSuccess?: (...args: any[]) => void;
//   cbError?: (...args: any[]) => void;
//   successToast?: boolean;
//   errorToast?: boolean;
//   errorHandler?: boolean;
// }

$("#profile-image-label").click(function (){
    let data = {
        'id': 5,
        'name': 'Mono'
    }
    $.ajax({
        url: URL + "/update" ,
        method: 'post',
        data: data,
        success: function (result){
            console.log(result.data)
        }
    })
})

// let config = {
//     data: {
//         id: 5,
//         name: 'Mono'
//     },
//     method: "POST"
// }
//
// function fetchData(config){
//     typeof config !== "object"
//         ? throw Error('Bad Request')
//         : $.ajax({
//             url: URL + "/update/11",
//             method: config.method,
//             data: config.data,
//             success: function (result){
//                 console.log(result.data)
//             }
//         })
//
// }
