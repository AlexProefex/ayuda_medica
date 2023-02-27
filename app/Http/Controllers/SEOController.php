<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEO;
class SEOController extends Controller
{
    public function index(){
        SEO::setTitle('Proyectos Proefex');
        SEO::setDescription('website listing proefex projects where you will find the details of each of them, both new and old');
        SEO::opengraph()->setUrl('https://proyectosproefex.com');
        SEO::setCanonical('https://proyectosproefex.com');
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@proyectosproefex');
        return view('index');
    }

    public function medical_consent(){
        SEO::setTitle('Consentimiento Medico');
        SEO::setDescription('Terminos y condiciones de Proefex - ayuda medica');
        SEO::opengraph()->setUrl('https://proyectosproefex.com');
        SEO::setCanonical('https://proyectosproefex.com');
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@proyectosproefex');
        return view('medical-consent');
    }

    public function term_conditions(){
        SEO::setTitle('Terminos y condiciones');
        SEO::setDescription('Terminos y condiciones de Proefex');
        SEO::opengraph()->setUrl('https://proyectosproefex.com');
        SEO::setCanonical('https://proyectosproefex.com');
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@proyectosproefex');
        return view('term-conditions');
    }

    public function privacy_policy(){
        SEO::setTitle('Politicas de privacidad');
        SEO::setDescription('Politicas de privacidad de Proefex');
        SEO::opengraph()->setUrl('https://proyectosproefex.com');
        SEO::setCanonical('https://proyectosproefex.com');
        SEO::opengraph()->addProperty('type', 'articles');
        SEO::twitter()->setSite('@proyectosproefex');
        return view('privacy-policy');
    }
}


