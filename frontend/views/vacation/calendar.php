<style type="text/css">
    table.table thead tr th, table.table tbody tr td {text-align: center;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<?php


use yii\helpers\Html;
use yii\base\Controller;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\VacationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Календарь отпусков';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="vacation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <form class="form-inline row">
        <div class="col-lg-2">
            <div class="input-group">
		  <span class="input-group-btn">
		    <button class="btn btn-primary" type="button" id="previous_year"><</button>
		  </span>
                <input type="text" class="form-control" id="yearText" value="2016">
		  <span class="input-group-btn">
		    <button class="btn btn-primary" type="button" id="next_year">></button>
		  </span>
            </div>
        </div>
    </form>

    <div class="row" style="margin-top: 20px;">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Январь</th> <th>Февраль</th> <th>Март</th> <th>Апрель</th> <th>Май</th> <th>Июнь</th>
                <th>Июль</th> <th>Август</th> <th>Сентябрь</th> <th>Октябрь</th> <th>Ноябрь</th> <th>Декабрь</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function() {
            runAjaxReq();

            $('#previous_year').click(function() {
                $('#yearText').val($('#yearText').val() - 1);
                runAjaxReq();
            });

            $('#next_year').click(function() {
                $('#yearText').val(+$('#yearText').val() + 1);
                runAjaxReq();
            });
        });

        function runAjaxReq() {
            $.ajax({
                type: "POST",
                url: '<?php echo Yii::$app->request->absoluteUrl ?>',
                data: { year: $('#yearText').val() },
                dateType: 'json',
                success: function(result) {
                    console.log(result);
                    $('table.table tbody').empty();
                    jsonToSchedule(result, $('#yearText').val());
                }
            })
        }

        function jsonToSchedule(result, year) {
            if(result != "") {
                var data = jQuery.parseJSON(result);
                var tbody = "";
                var yearStart = 0;
                var yearStop = 0;
                var monthStop = 0;
                var monthStart = 0;
                var dayStart = 0;
                var dayStop = 0;
                for(var i=0; i<data.length; i++) {
                    yearStart = parseInt(data[i].date_start.substr(0, 4));
                    yearStop = parseInt(data[i].end_date.substr(0, 4));
                    monthStart = parseInt(data[i].date_start.substr(5, 2));
                    monthStop = parseInt(data[i].end_date.substr(5, 2));
                    dayStart = parseInt(data[i].date_start.substr(8, 2));
                    dayStop = parseInt(data[i].end_date.substr(8, 2));
                    tbody += "<tr>";
                    tbody += "<td>"+data[i].full_name+"</td>";

                    if(yearStart == yearStop) {
                        console.log("if");
                        var j=1;
                        while(j<=12) {
                            if(j==monthStart) {
                                if(monthStart == monthStop) {
                                    tbody += '<td style="background-color: #337AB7; color: #F5F5F5;">'+dayStart+' - '+dayStop+'</td>';
                                    j=j+1;
                                }
                                else {
                                    tbody += '<td style="background-color: #337AB7; color: #F5F5F5;">'+dayStart+'</td>';
                                    for(var k=1; k<Math.abs(monthStop - monthStart); k++) {
                                        tbody += '<td style="background-color: #337AB7; color: #F5F5F5;"></td>';
                                        j=j+1;
                                    }
                                    tbody += '<td style="background-color: #337AB7; color: #F5F5F5;">'+dayStop+'</td>';
                                    j=j+2;
                                }
                            }
                            else {
                                tbody += "<td></td>";
                                j=j+1;
                            }
                        }
                    }
                    else if(yearStart == year && yearStop != year) {
                        console.log("else if");
                        for(var k=1; k<monthStart; k++) tbody += "<td></td>";
                        tbody += '<td style="background-color: #337AB7; color: #F5F5F5;">'+dayStart+'</td>';
                        for(var k=monthStart+1; k<=12; k++) tbody += '<td style="background-color: #337AB7; color: #F5F5F5;"></td>';
                    }
                    else {
                        console.log("else");
                        for(var k=1; k<monthStop; k++) tbody += '<td style="background-color: #337AB7; color: #F5F5F5;"></td>';
                        tbody += '<td style="background-color: #337AB7; color: #F5F5F5;">'+dayStop+'</td>';
                        for(var k=monthStop+1; k<=12; k++) tbody += "<td></td>";
                    }
                    tbody += "</tr>";
                }
                $('table.table tbody').append(tbody);
            }
        }
    </script>

</div>
