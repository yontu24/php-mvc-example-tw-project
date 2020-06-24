<!DOCTYPE html>
<html lang="ro">
<head>
    <title>TW Project DOC</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="View/icons/webicon.png" type="image/x-icon">
    <link rel="stylesheet" href="http://localhost/obis/public/style/doc.css">
</head>
<body>
<div class="container">
    <div class="custom-button"><a onClick="history.go(-1)" title="Return to last page" >BACK</a></div>
    <div class="title-container"><b>DOCUMENTATIE</b></div>
    <ul class="content-list">
        <li class="item"><a href="#abtr" title="Abstract">1. Abstract</a></li>
        <li class="item"><a href="#intro" title="Introducere">2. Introducere</a></li>
        <li class="item"><a href="#arh" title="Arhitectura">3. Arehitectura</a></li>
        <li class="item"><a href="#str" title="Structura">4. Structura</a></li>
        <li class="remove-dot">
            <ul>
                <li class="item"><a href="#str" title="Front-end">Front-end</a></li>
                <li class="item"><a href="#str" title="Back-end">Back-end</a></li>
                <li class="item"><a href="#str" title="Integrare">Integrare</a></li>
            </ul>
        </li>
        <li class="item"><a href="#tw" title="Tehnologii folosite">Tehnologii folosite</a></li>
        <li class="item"><a href="#mt" title="Metodologii">Metodologii</a></li>
        <li class="remove-dot">
            <ul>
                <li class="item"><a title="GitHub">GitHub</a></li>
                <li class="item"><a title="Kanban">Kanban</a></li>
                <li class="item"><a title="Agile">Agile</a></li>
            </ul>
        </li>
        <li class="item"><a href="#tasks" title="Sarcini"></a></li>
        <li class="item"><a href="#contact" title="Contact">Contact</a></li>
        <li class="item"><a href="#bibl" title="Bibliografie">Bibliografie</a></li>
    </ul>

    <section id="abtr">
        <div>
            <h3 class="title-container">Abstract</h3>
            <div>Numele proiectului Obis vine de la Obesity Prevalence Visualizer si se refera la
                o platforma web pe care se pot vizualiza diferite statistici bazate
                pe ani, locatii si categorii de greutate a persoanelor din SUA randate in functie
                de categorii specifice.
            </div>
        </div>
    </section>

    <section id="intro">
        <div>
            <h3 class="title-container">Introducere</h3>
            <div>
                Aplicatia ofera acces utilizatorilor la vizualizarea datelor colectate de <em>Behavioral Risk Factor
                    Surveillance System</em> prin intermediul unui API REST propriu. Utilizatorul poate alege diferite
                criterii
                pe baza carora vor fi randate grafice ce vor putea fi exportate in formatele CSV, WEBp, PDF si SVG.
            </div>
        </div>
    </section>

    <section id="arh">
        <div>
            <h3 class="title-container">Arhitectura</h3>
            <div>Arhitectura aleasa este cea de tip MVC (Model-View-Controller) ce separa structura codului in 3 parti:
            </div>
            <ul>
                <li>
                    <div class="sub-list">Model</div>
                    <div>

                    </div>
                </li>
                <li>
                    <div class="sub-list">View</div>
                    <div>

                    </div>
                </li>
                <li>
                    <div class="sub-list">Controller</div>
                    <div>

                    </div>
                </li>
            </ul>
            <img src="../../public/icons/MCV_1.png" alt="">

            <div>
                <b>Controller-ul</b> decide ce view-uri sa reprezeinte. Controller-ul face de asemenea management pentru
                date.
                Datele sunt pasate prin parametri.
            </div>
            <div><b>Model-ul</b> trimite datele la controller. Datele sunt obtinute facand o cerere
                la REST API.
            </div>
            <div>
                <b>View-ul</b> afiseaza datele primite de la controller.
            </div>
            <img src="../../public/icons/umld.png" alt="">
        </div>
    </section>

    <section id="str">
        <div>
            <h3 class="title-container">Structura</h3>
            <ul>
                <li>
                    <div class="sub-list">Front-end</div>
                    <div>
                        Partea de frontend a fost construita cu HTML5 si CSS3 pentru design-ul tag-urilor cat si pentru
                        adaugarea de efecte/tranzitii animate. Aceasta contine si o sectiune care randeaza date dinamic
                        folosind AJAX, iar graficele sunt reprezentate folosind JavaScript.
                    </div>
                </li>
                <li>
                    <div class="sub-list">Back-end</div>
                    <div>
                        <ul>
                            <li>
                                <div>
                                    Utilizatorul are acces doar la directorul <em>Public</em>, accesul fiind oferit de
                                    optiunile din fisierul
                                    .htacces. Initializarea aplicatiei este oferita de fisierul index.php.
                                    <pre>
                                        <code>
require_once('../app/init.php');
$app = new App();
                                        </code>
                                    </pre>
                                </div>
                            </li>
                            <li>
                                <div class="sub-list">App</div>
                                <div>
                                    Folderul App contine aplicatia realizata dupa sablonul MVC.
                                    <ul>
                                        <li>
                                            <div class="sub-list">Core <br></div>
                                            <div>
                                                Contine clasele de baza care dau logica aplicatiei.
                                                <pre>
                                                    <code>
        class App
        {
            // default
            protected $controller = 'home';
            protected $method = 'index';
            protected $params = [];

            public function __construct()
            {
                $url = $this->parseUrl();
                if (!empty($url)) {
                    if (file_exists('../app/controllers/' . $url[0] . '.php')) {
                        $this->controller = $url[0];
                        unset($url[0]);
                    }
                } else {
                    echo 'Go to /home/index/';
                }

                require_once '../app/controllers/' . $this->controller . '.php';

                $this->controller = new $this->controller;

                if (isset($url[1])) {
                    if (method_exists($this->controller, $url[1])) {
                        $this->method = $url[1];
                        unset($url[1]);
                    }
                }

                $this->params = $url ? array_values($url) : [];
                call_user_func_array([$this->controller, $this->method], $this->params);
            }

            public function parseUrl()
            {
                if (isset($_GET['url'])) {
                    return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
                }
            }
        }
                                                    </code>
                                                </pre>
                                                Din acestea se vor extinde functionalitatile
                                                principale.
                                                <pre>
                                                    <code>
        class Controller
        {
            public function model($model)
            {
                require_once '../app/models/' . $model . '.php';
                return new $model;
            }

            public function view($view, $data1 = [], $data2 = [], $data3 = [], $data4 = [], $data5 = [])
            {
                require_once '../app/views/' . $view . '.php';
            }
        }
                                                    </code>
                                                </pre>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sub-list">Controllers</div>
                                            <div>
                                                Sunt extinse din core/Controller si sunt responsabile de
                                                comportamentul
                                                aplicatiei stabilind de la
                                                ce model vor fi luate datele si oferind vizualizarile pe baza acelor
                                                date. <br>
                                                <em>Home</em>: prin metoda index se ofera vizualizarea paginii
                                                principale.<br>
                                                <em>Results</em>: metoda index ofera vizualizarea pasului unu in
                                                generarea
                                                graficelor iar metoda formularTip incarca pasul doi in functie de
                                                alegerea facuta anterior.<br>
                                                <em>Comparisons/Statistics</em>: prin metoda index incarca pasul trei,
                                                iar
                                                metoda stats incarca pagina cu tipul de grafic ales.
                                                <pre>
                                                    <code>
    class Comparisons extends Controller
    {
        public function index()
        {
            $loc = $this->model('Location');
            $loc->value = $loc->getData();
            $year = $this->model('Year');
            $year->value = $year->getData();
            $response = $this->model('Response');
            $response->value = $response->getData();
            $category = $this->model('Category');
            $category->value = $category->getData();

            if (isset($_POST['filterChart'])) {
                ?>
                &lt;script type=text/javascript>
                    localStorage.setItem('chartType', '&lt;?php echo $_POST['filterChart'] ?>');
                &lt;/script>
                &lt;?php
            }

            $this->view('comparison/index', $loc->value, $year->value, $response->value, $category->value);
        }

        public function stats()
        {
            $data = $this->model('Comparison');
            $data->values = $data->getData();
            $this->view('comparison/comparison-chart', $data->values);
        }
    }
                                                    </code>
                                                </pre>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sub-list">Models</div>
                                            <div>
                                                Cuprinde clasele responsabile de schimbul de informatii cu API REST.
                                                Fiecare clasa va face o
                                                cerere de tip cURL pentru datele necesare (Category - toate
                                                categoriile, Locations - toate locatiile,
                                                Response - toate categoriile de greutate, Year - toti anii iar
                                                AllFilters si Comparison toate cazurile grupate
                                                pe categorii in functie de parametrii selectati).
                                                <pre>
                                                    <code>
    class Year extends Model
    {
        public $years = array();
        private static $url = 'http://localhost/OBIS/REST/api/info/ani/read.php';

        public function __construct()
        {
            $response = Model::getDataResponse(self::$url);
            $jsonIterator = new RecursiveIteratorIterator(<br>new RecursiveArrayIterator($response), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($jsonIterator as $key => $val) {
                if (!is_array($val) && $key === "ani") {
                    array_push($this->years, $val);
                }
            }
        }

        public function getData()
        {
            return $this->years;
        }
    }
                                                    </code>
                                                </pre>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sub-list">Views</div>
                                            <div>
                                                Contine paginile oferite prin intermediul aplicatiei. <br>
                                                Home: pagina principala contine date generale despre obezitate si
                                                functionalitate care permite o vizualizare
                                                rapida a anumitor statistici.
                                                Result: pagina cu primul pas(alegerea variantei de realizare a
                                                graficului).
                                                Comparison/Statistics: paginile cu pasii ramasi si reprezentarea
                                                graficelor.
                                                <pre>
                                                    <code>
        function drawChart() {
            var obj = &lt;?php echo json_encode($date) ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'label');
            data.addColumn('number', 'cazuri');

            for (var i = 0; i < obj.length; i++) {
                data.addRow([
                    obj[i][0][0], parseInt(obj[i][1][0], 10)
                ]);
            }
            var options = {
                title: 'Number of cases of ' + localStorage.getItem('response') + ' people  in ' + <br>localStorage.getItem('location') + ', year(s): ' + localStorage.getItem('year')
            };
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
                                                    </code>
                                                </pre>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="sub-list">API REST</div>
                    <div>
                        Ofera o reprezentare a informatiilor din baza de date in functie de cererea procesata.
                        <ul>
                            <li>
                                <div class="sub-list">Models</div>
                                <div>
                                    - contine clasele corespunzatoare fiecarui substantiv responsabile
                                    de comunicarea cu baza de date.
                                </div>
                            </li>
                            <li>
                                <div class="sub-list">API</div>
                                <div>
                                    - contine fiserele care interactioneaza cu utilizatorul.
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="tw">
        <div>
            <h3 class="title-container">Tehnologii folosite</h3>
            <ul>
                <li class="sub-list"><a href="https://en.wikipedia.org/wiki/HTML5">HTML5</a></li>
                <li class="sub-list"><a href="https://www.w3.org/Style/CSS/Overview.en.html">CSS</a></li>
                <li class="sub-list"><a href="https://en.wikipedia.org/wiki/JavaScript">JAVASCRIPT</a></li>
                <li class="sub-list"><a href="https://www.php.net/">PHP</a></li>
            </ul>
        </div>
    </section>

    <section id="mt">
        <div>
            <h3 class="title-container">Metodologii folosite</h3>
            <ul>
                <li class="sub-list"><a href="https://github.com/">GitHub</a></li>
                <li class="sub-list">Kanban</li>
                <li class="sub-list">Agile</li>
                <li>
                    <div>
                        Modelele de dezvoltare folosite in decursul implementarii codului au fost agile din punct de
                        vedere
                        al timpului si al task-urilor de realizat, dar si kanban pentru impartirea task-urilor si
                        rezolvarea acestora prioritar.
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="tasks">
        <div>
            <h3 class="title-container">Sarcini</h3>
            <ul>
                <li>
                    <div class="sub-list">
                        Backend
                    </div>
                    <ul>
                        <li>
                            <div class="sub-list">REST API : Ivascu Vlad-Alexandru</div>
                        </li>
                        <li>
                            <div class="sub-list">Schelet MVC : Craciun Ioan-Paul</div>
                        </li>
                        <li>
                            <div class="sub-list">Controllers:</div>
                            <ul>
                                <li>
                                    <div class="sub-list">home, comparisons : Craciun Ioan-Paul</div>
                                </li>
                                <li>
                                    <div class="sub-list">statistics : Aparaschivei Sebastian-Nicolae</div>
                                </li>
                                <li>
                                    <div class="sub-list">results : Ivascu Vlad-Alexandru</div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="sub-list">Models</div>
                            <ul>
                                <li>
                                    <div class="sub-list">Location, Comparison, Model : Craciun Ioan-Paul</div>
                                </li>
                                <li>
                                    <div class="sub-list">AllFilters, Category, Response, Year : Aparaschivei Sebastian-Nicolae</div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="sub-list">Views</div>
                            <ul>
                                <li>
                                    <div class="sub-list">Structurare Views (Step 1, Step 2) : Ivascu Vlad-Alexandru</div>
                                </li>
                                <li>
                                    <div class="sub-list">Statistics (Step 3) : Aparaschivei Sebastian-Nicolae</div>
                                </li>
                                <li>
                                    <div class="sub-list">Comparison (Step 3) : Craciun Ioan-Paul</div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="sub-list">
                        Frontend
                    </div>
                    <ul>
                        <li>
                            <div class="sub-list">Tool in AJAX pentru query rapid (pagina principala jos) : Aparaschivei Sebastian-Nicolae</div>
                        </li>
                        <li>
                            <div class="sub-list">Pagina principala (Home) : Craciun Ioan-Paul</div>
                        </li>
                        <li>
                            <div class="sub-list">Step 1 & 2 : Aparaschivei Sebastian-Nicolae, Ivascu Vlad-Alexandru</div>
                        </li>
                        <li>
                            <div class="sub-list">Step 3 : Craciun Ioan-Paul, Aparaschivei Sebastian-Nicolae, Ivascu Vlad-Alexandru</div>
                        </li>
                        <li>
                            <div class="sub-list">Afisare graf : Aparaschivei Sebastian-Nicolae, Ivascu Vlad-Alexandru</div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>

    <section id="contact">
        <div>
            <h3 class="title-container">Contact</h3>
            <ul>
                <li class="sub-list">Ivascu Vlad-Alexandru</li>
                <li class="remove-dot">
                    <ul>
                        <li class="sub-list"><a href="https://github.com/IvascuVlad">https://github.com/IvascuVlad</a>
                        </li>
                        <li class="sub-list"><a href="mailto:ivascu2vlad@gmail.com">ivascu2vlad@gmail.com</a></li>
                    </ul>
                </li>
                <li class="sub-list">Craciun Ioan-Paul</li>
                <li class="remove-dot">
                    <ul>
                        <li class="sub-list"><a href="https://github.com/yontu24">https://github.com/yontu24</a></li>
                        <li class="sub-list"><a href="mailto:cip.ionut24@gmail.com">cip.ionut24@gmail.com</a></li>
                    </ul>
                </li>
                <li class="sub-list">Aparaschivei Sebastian-Nicolae</li>
                <li class="remove-dot">
                    <ul>
                        <li class="sub-list"><a
                                    href="https://github.com/SebastianAp27">https://github.com/SebastianAp27</a>
                        </li>
                        <li class="sub-list"><a href="mailto:sebastianap271@gmail.com">sebastianap271@gmail.com</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>

    <section id="bibl">
        <div>
            <h3 class="title-container">Bibliografie</h3>
            <ul>
                <li class="sub-list"><a href="https://profs.info.uaic.ro/~andrei.panu/">Web Technologies Dr. Andrei
                        Panu</a></li>
                <li class="sub-list"><a href="https://profs.info.uaic.ro/~busaco/teach/courses/web/">Tehnologii Web Dr.
                        Sabin-Corneliu Buraga</a></li>
                <li class="sub-list"><a
                            href="https://medium.com/datadriveninvestor/model-view-controller-mvc-75bcb0103d66">Model-View-Controller
                        picture</a></li>
                <li class="sub-list"><a
                            href="https://www.geeksforgeeks.org/javascript-importing-and-exporting-modules/">Importing
                        and
                        exporting modules</a></li>
                <li class="sub-list"><a href="https://developers.google.com/chart/interactive/docs/printing">Printing
                        PNG Charts</a></li>
                <li class="sub-list"><a
                            href="https://stackoverflow.com/questions/18595651/saving-and-printing-a-google-chart">stackoverflow:
                        Saving and printing a google chart</a></li>
                <li class="sub-list"><a href="https://developers.google.com/chart">Google charts</a></li>
                <li class="sub-list"><a href="https://www.iconfinder.com/">Icon finder: Pictures</a></li>
                <li class="sub-list"><a href="https://validator.w3.org/">W3C Markup Validation Service</a></li>
                <li class="sub-list"><a href="http://csslint.net//">CSS Lint</a></li>
            </ul>
        </div>
    </section>
</div>
</body>
</html>