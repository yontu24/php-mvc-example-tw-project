<?php
function GetResponse(){
  return['Obese (BMI 30.0 - 99.8)','Normal Weight (BMI 18.5-24.9)','Overweight (BMI 25.0-29.9)','Underweight (BMI 12.0-18.4)'];
}
$raspuns=GetResponse();
function GetBreakOutCategory(){
  return['Household Income','Race/Ethnicity','Age Group','Education Attained','Overall','Gender'];
}
$breakOutCategory=GetBreakOutCategory();
function GetBreakOutIncome(){
  return['$25,000-$34,999','$50,000+','Less than $15,000','$15,000-$24,999','$35,000-$49,999'];
}
$breakOutIncome=GetBreakOutIncome();
function GetBreakOutRace(){
  return['Black, non-Hispanic','Other, non-Hispanic','Asian, non-Hispanic','Hispanic','White, non-Hispanic','Native Hawaiian or other Pacific Islander, non-His...
  ','Multiracial, non-Hispanic','American Indian or Alaskan Native, non-Hispanic'];
}
$breakOutRace=GetBreakOutRace();
function GetBreakOutAge(){
  return['35-44','55-64','18-24','65+','25-34','45-54'];
}
$breakOutAge=GetBreakOutAge();
funtion GetBreakOutGender(){
  return['Female','Male'];
}
$breakOutGender=GetBreakOutGender();
function GetBreakoutEducation(){
  return['H.S. or G.E.D.','Some post-H.S.','College graduate','Less than H.S.'];
}
$breakOutGender=GetBreakOutGender();
function GetBreakoutOverall(){
  return['Overall'];
}
$breakOutOverall=GetBreakoutOverall();
function GetYears(){
  return['2011','2012','2013','2014','2015','2016','2017','2018'];
}
$years=GetYears();
function GetLocations(){
  return['Puerto Rico','Wisconsin','Guam','Wyoming','All States and DC (median) **','All States, DC and Territories (median) **','Washington','West Virginia','Virginia',
'Vermont','Tennessee','Texas','Utah','Rhode Island','South Dakota','South Carolina','Pennsylvania','Oklahoma','Ohio','Oregon','New York','North Dakota','North Carolina',
'New Mexico','New Hampshire','Nevada','New Jersey','Missouri','Nebraska','Montana','Minnesota','Mississippi','Michigan','Massachusetts','Maryland',
'Maine','Louisiana','Kentucky','Kansas','Iowa','Indiana','Georgia','Illinois','Hawaii','Idaho','District of Columbia','Delaware','Florida','Arkansas',
'Connecticut','Colorado','California','Alabama','Arizona','Alaska','Virgin Islands'];
}
$locations=GetLocations();

?>
