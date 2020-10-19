@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>How to use the catalog:</h1>
        </div>

        <p class="lead">The user interface of the platform is pretty intuitive. The landing page is called <b>"Introduction"</b>. In the <b>"Taxa"</b> dropdown there are two options: <b>"Search for taxon"</b> and <b>"List all families"</b>. The first one allows the user to search directly for particular Family, Genus or Species. The second one lists all the spider Families known from the Balkan Peninsula with the number of genera and species for each of them. The <b>"Statistics"</b> dropdown contains different statistical options. This section is to be extended with more functionality in the future. There is also a <b>"Literature"</b> section which contains all the cited literature and a standard <b>"Contact"</b> page.</p>

        <p class="lead">The Authentication system consists of <a href="http://spiders.test/login">login</a> and <a href="http://spiders.test/register">register</a> page. Although all the data on the platform can be accessed for free, some specific functionality, as for example the different download options, are available only for registered users. The user's <a href="http://spiders.test/home">home page</a> is still under development and will provide the users an option to change their account's details.</p>

        

    </div>
@endsection