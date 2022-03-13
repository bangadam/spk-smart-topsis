<li class="nav-item">
    <a href="{{ route('criterias.index') }}"
       class="nav-link {{ Request::is('criterias*') ? 'active' : '' }}">
        <p>Criterias</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('sub-criterias.index') }}"
       class="nav-link {{ Request::is('subCriterias*') ? 'active' : '' }}">
        <p>Sub Criterias</p>
    </a>
</li>






<li class="nav-item">
    <a href="{{ route('surveyors.index') }}"
       class="nav-link {{ Request::is('surveyors*') ? 'active' : '' }}">
        <p>Surveyors</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('waves.index') }}"
       class="nav-link {{ Request::is('waves*') ? 'active' : '' }}">
        <p>Waves</p>
    </a>
</li>





<li class="nav-item">
    <a href="{{ route('populations.index') }}"
       class="nav-link {{ Request::is('populations*') ? 'active' : '' }}">
        <p>Populations</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('populationAssesments.index') }}"
       class="nav-link {{ Request::is('populationAssesments*') ? 'active' : '' }}">
        <p>Population Assesments</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('receivers.index') }}"
       class="nav-link {{ Request::is('receivers*') ? 'active' : '' }}">
        <p>Receivers</p>
    </a>
</li>


