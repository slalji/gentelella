var output = [{"FieldName":"Problem","Totals":1,"Calendar":"2011.11"},{"FieldName":"Environment","Totals":0,"Calendar":"2011.11"},{"FieldName":"Root Cause","Totals":0,"Calendar":"2011.11"},{"FieldName":"Notes","Totals":0,"Calendar":"2011.11"},{"FieldName":"Controls","Totals":0,"Calendar":"2011.11"},{"FieldName":"Resolution","Totals":0,"Calendar":"2011.11"},{"FieldName":"Summary","Totals":0,"Calendar":"2011.11"},{"FieldName":"Script","Totals":0,"Calendar":"2011.11"},{"FieldName":"Customer Message","Totals":0,"Calendar":"2011.11"},{"FieldName":"Tags","Totals":0,"Calendar":"2011.11"},{"FieldName":"Problem","Totals":0,"Calendar":"2012.1"},{"FieldName":"Environment","Totals":1,"Calendar":"2012.1"},{"FieldName":"Root Cause","Totals":2,"Calendar":"2012.1"},{"FieldName":"Notes","Totals":2,"Calendar":"2012.1"},{"FieldName":"Controls","Totals":0,"Calendar":"2012.1"},{"FieldName":"Resolution","Totals":0,"Calendar":"2012.1"},{"FieldName":"Summary","Totals":0,"Calendar":"2012.1"},{"FieldName":"Script","Totals":0,"Calendar":"2012.1"},{"FieldName":"Customer Message","Totals":0,"Calendar":"2012.1"},{"FieldName":"Tags","Totals":0,"Calendar":"2012.1"},{"FieldName":"Problem","Totals":0,"Calendar":"2012.3"},{"FieldName":"Environment","Totals":0,"Calendar":"2012.3"},{"FieldName":"Root Cause","Totals":0,"Calendar":"2012.3"},{"FieldName":"Notes","Totals":0,"Calendar":"2012.3"},{"FieldName":"Controls","Totals":1,"Calendar":"2012.3"},{"FieldName":"Resolution","Totals":0,"Calendar":"2012.3"},{"FieldName":"Summary","Totals":0,"Calendar":"2012.3"},{"FieldName":"Script","Totals":0,"Calendar":"2012.3"},{"FieldName":"Customer Message","Totals":0,"Calendar":"2012.3"},{"FieldName":"Tags","Totals":0,"Calendar":"2012.3"},{"FieldName":"Problem","Totals":19,"Calendar":"2012.4"},{"FieldName":"Environment","Totals":6,"Calendar":"2012.4"},{"FieldName":"Root Cause","Totals":3,"Calendar":"2012.4"},{"FieldName":"Notes","Totals":2,"Calendar":"2012.4"},{"FieldName":"Controls","Totals":0,"Calendar":"2012.4"},{"FieldName":"Resolution","Totals":13,"Calendar":"2012.4"},{"FieldName":"Summary","Totals":6,"Calendar":"2012.4"},{"FieldName":"Script","Totals":3,"Calendar":"2012.4"},{"FieldName":"Customer Message","Totals":1,"Calendar":"2012.4"},{"FieldName":"Tags","Totals":1,"Calendar":"2012.4"}];
 
     var fieldNames = new Array();
                for (var i = 0; i < output.length; i++) {
                    if (fieldNames.indexOf(output[i].FieldName) < 0) {
                        fieldNames.push(output[i].FieldName);
                    }
                }
                var calendar = new Array();
                for (var i = 0; i < output.length; i++) {
                    if (calendar.indexOf(output[i].Calendar) < 0) {
                        calendar.push(output[i].Calendar);
                    }
                }
                var xAxis = [];
                for (var i = 0; i < calendar.length; i++) {
                    xAxis.push([parseInt(i + 1), calendar[i]]);
                }
                var data = [];
                for (var i = 0; i < fieldNames.length; i++) {
                    var values = [];
                    var count = 0;
                    for (var j = 0; j < output.length; j++) {
                        if (fieldNames[i] === output[j].FieldName) {
                            count++;
                            values.push([parseInt(count), parseInt(output[j].Totals)]);                            
                        }
                    }
         data.push({ "label": fieldNames[i].toString(), "data": values });
                }
                var options = {
                    series: {
                        bars: { show: true }
                    },
                    xaxis: { ticks: xAxis },
                    yaxis:{min:0}
                };
                plot = $.plot($("#divMetricsDetailGraph"), data, options);