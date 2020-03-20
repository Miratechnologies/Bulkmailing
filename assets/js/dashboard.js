

async function loadEmailChart(labels,values) {
   const config = {
      type: 'bar',
      data: {
         labels: labels,
         datasets: [{
            label: 'Number of Email Sent',
            fill: false,
            backgroundColor: window.chartColors.obejor,
            borderColor: window.chartColors.obejor,
            data: values,
         }]
      },
      options: {
         responsive: true,
         title: {
            display: true,
            text: 'Obejor Email Campaign'
         },
         scales: {
            xAxes: [{
               display: true,
               scaleLabel: {
                  display: true,
                  labelString: 'Date'
               }
            }],
            yAxes: [{
               display: true,
               scaleLabel: {
                  display: true,
                  labelString: 'Value'
               },
               ticks: {
                  beginAtZero: true
            }
            }]
         }
      }
   };
   

   var ctx = document.getElementById('email_canvas').getContext('2d');
   if (window.myChart != undefined)
   window.myChart.destroy();
   window.myChart = new Chart(ctx, config);
}

async function loadSMSChart(labels,values) {
   const config = {
      type: 'bar',
      data: {
         labels: labels,
         datasets: [{
            label: 'Number of SMS Sent',
            fill: false,
            backgroundColor: window.chartColors.grey,
            borderColor: window.chartColors.grey,
            data: values,
         }]
      },
      options: {
         responsive: true,
         title: {
            display: true,
            text: 'Obejor SMS Campaign'
         },
         scales: {
            xAxes: [{
               display: true,
               scaleLabel: {
                  display: true,
                  labelString: 'Date'
               }
            }],
            yAxes: [{
               display: true,
               scaleLabel: {
                  display: true,
                  labelString: 'Value'
               },
               ticks: {
                  beginAtZero: true
            }
            }]
         }
      }
   };
   

   var ctx = document.getElementById('sms_canvas').getContext('2d');
   if (window.myChart != undefined)
   window.myChart.destroy();
   window.myChart = new Chart(ctx, config);
}

window.onload = async function() {
   hideSmsStats();
   showEmailStats();
   // await getStatistics()
};

async function getEmailStatistics() {

   labels = [];
   values = [];

   const data = new FormData();
   data.append('list', 'recent')

   await fetch('scripts/get_email_statistics.php', {
      method: "POST",
      body: data
   }).then(res => res.json())
   .then(result => {
      if (result.flag) {
         result.data.forEach(elem => {
            var date = new Date(elem.date);
            labels.push( date.getDate() + "/" + (date.getMonth() + 1)  + "/" + date.getFullYear());
            values.push(elem.mails);
         });

         loadEmailChart(labels, values);
      } else {
         console.log(result.data);
      }
      
   })
   .catch(error => console.log(error));
}

async function getEmailStatisticsByDate() {
   
   labels = [];
   values = [];

   var startDate = $("#emailStartDate").val();
   var endDate = $("#emailEndDate").val();
   
   var data = new FormData();
   data.append('list', 'range')
   data.append('startDate',startDate);
   data.append('endDate',endDate);

   await fetch('scripts/get_email_statistics.php', {
      method: "POST",
      body: data
   }).then(res => res.json())
   .then(result => {
      if (result.flag) {
         result.data.forEach(elem => {
            console.log(elem.date);
            var date = new Date(elem.date);
            labels.push( date.getDate() + "/" + (date.getMonth() + 1)  + "/" + date.getFullYear());
            values.push(elem.mails);
         });

         loadEmailChart(labels, values);
      } else {
         console.log(result.data);
      }
      
   })
   .catch(error => console.log(error.response));
}

async function getSMSStatistics() {

   labels = [];
   values = [];

   const data = new FormData();
   data.append('list', 'recent')

   await fetch('scripts/get_sms_statistics.php', {
      method: "POST",
      body: data
   }).then(res => res.json())
   .then(result => {
      if (result.flag) {
         result.data.forEach(elem => {
            var date = new Date(elem.date);
            labels.push( date.getDate() + "/" + (date.getMonth() + 1)  + "/" + date.getFullYear());
            values.push(elem.sms);
         });

         loadSMSChart(labels, values);
      } else {
         console.log(result.data);
      }
      
   })
   .catch(error => console.log(error));
}

async function getSMSStatisticsByDate() {
   
   labels = [];
   values = [];

   var startDate = $("#smsStartDate").val();
   var endDate = $("#smsEndDate").val();
   
   var data = new FormData();
   data.append('list', 'range')
   data.append('startDate',startDate);
   data.append('endDate',endDate);

   await fetch('scripts/get_sms_statistics.php', {
      method: "POST",
      body: data
   }).then(res => res.json())
   .then(result => {
      if (result.flag) {
         result.data.forEach(elem => {
            console.log(elem.date);
            var date = new Date(elem.date);
            labels.push( date.getDate() + "/" + date.getMonth() + 1  + "/" + date.getFullYear());
            values.push(elem.sms);
         });

         loadSMSChart(labels, values);
      } else {
         console.log(result.data);
      }
      
   })
   .catch(error => console.log(error.response));
}


function showEmailStats() {
   hideSmsStats();
   $("#emailStat").show();
   getEmailStatistics();
}

function showSMSStats() {
   hideEmailStats();
   $("#smsStat").show();
   getSMSStatistics();
}

function hideEmailStats() {
   $("#emailStat").hide();
}

function hideSmsStats() {
   $("#smsStat").hide();
}