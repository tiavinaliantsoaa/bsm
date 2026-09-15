<?php

declare(strict_types=1);

namespace App\Data;

/**
 * SiteData
 * --------
 * Central content repository. Copy is sourced from the BSM-Services
 * site-text draft (propositions de textes, page par page).
 */
final class SiteData
{
    /** Company identity used by JSON-LD and the footer. */
    public static function company(): array
    {
        return [
            'name'        => 'BSM-Services',
            'legal_name'  => 'BSM-Services SARL',
            'tagline'     => 'Externalisation cadres pour PME et start-ups.',
            'baseline'    => 'Nous voulons inventer un nouveau modèle d’externalisation, au service des PME et start-ups.',
            'email'       => 'contact@bsm-services.com',
            'phone_fr'    => '+33 1 85 08 18 96',
            'phone_mg'    => '+261 34 15 702 05',
            'linkedin'    => 'https://www.linkedin.com/company/bsm-services.com/',
            'founded'     => 2016,
            'rcs'         => 'B 00488 – RCS Antananarivo',
            'capital'     => '10 000 000 Ariary',
            'address' => [
                'street'  => 'Immeuble Le Colisé Ampasanimalo/Tsiadana',
                'zip'     => '101',
                'city'    => 'Antananarivo',
                'country' => 'Madagascar',
                'geo'     => ['lat' => -18.9175263, 'lng' => 47.5480892],
            ],
            'hours' => [
                ['days' => 'Lundi – Vendredi', 'hours' => '08:30 – 17:30'],
                ['days' => 'Samedi – Dimanche', 'hours' => 'Sur rendez-vous'],
            ],
        ];
    }

    /** Primary navigation. Keeps controllers and layout in sync. */
    public static function navigation(): array
    {
        return [
            ['label' => 'À propos',        'route' => 'about'],
            ['label' => 'Nos prestations', 'route' => 'services.index'],
            ['label' => 'Recrutement',     'route' => 'recrutement'],
            ['label' => 'Contact',         'route' => 'contact.show'],
        ];
    }

    /** Core service offerings listed in the site-text draft. */
    public static function services(): array
    {
        return [
            [
                'slug'    => 'commercial',
                'title'   => 'Commercial',
                'lead'    => 'Structurez et accélérez votre développement commercial avec des cadres dédiés.',
                'icon'    => 'briefcase',
                'summary' => 'Externalisez la prospection, la réponse aux appels d’offres et vos outils commerciaux.',
                'benefits' => [
                    'Un pilotage clair, avec un ETP dédié à vos comptes.',
                    'Des reportings hebdomadaires pour suivre l’avancement.',
                    'Une montée en charge progressive, sans engagement lourd.',
                ],
                'deliverables' => [
                    'Prospection commerciale téléphonique (1 ou 2 ETP).',
                    'Rédaction de propositions commerciales et de réponses à appels d’offres.',
                    'Mise en place de documents commerciaux : plaquettes, flyers, ciblage de prospects.',
                ],
                'related' => ['veille', 'web-marketing'],
            ],
            [
                'slug'    => 'etudes',
                'title'   => 'Études de marché & Business Plan',
                'lead'    => 'De la validation d’une idée à la modélisation financière d’une Business Unit.',
                'icon'    => 'chart',
                'summary' => 'De la validation d’une idée à la modélisation financière d’une Business Unit.',
                'benefits' => [
                    'Des hypothèses financières argumentées et challengeables.',
                    'Une méthodologie transparente, audit-ready.',
                    'Un livrable exploitable en comité d’investissement.',
                ],
                'deliverables' => [
                    'Études de marché pour création d’entreprise ou nouvelle Business Unit.',
                    'Rédaction de Business Plans narratifs et financiers à plusieurs hypothèses.',
                ],
                'related' => ['veille', 'web-marketing'],
            ],
            [
                'slug'    => 'veille',
                'title'   => 'Veille',
                'lead'    => 'Une intelligence de marché proactive, formatée pour vos comités de direction.',
                'icon'    => 'radar',
                'summary' => 'Une intelligence de marché proactive, formatée pour vos comités de direction.',
                'benefits' => [
                    'Une lecture stratégique de votre écosystème.',
                    'Des livrables prêts à l’emploi pour vos consultants et vos clients.',
                    'Un rythme de veille adapté à votre cycle de décision.',
                ],
                'deliverables' => [
                    'Veille proactive pour anticiper les futures tendances de votre marché.',
                    'Conception de books de tendance pour consultants et cabinets de conseil.',
                    'Missions de veille prospective sur horizons 6 à 24 mois.',
                ],
                'related' => ['web-marketing', 'etudes'],
            ],
            [
                'slug'    => 'web-marketing',
                'title'   => 'Community Management et Web marketing',
                'lead'    => 'Le pilotage de vos campagnes digitales.',
                'icon'    => 'megaphone',
                'summary' => 'Le pilotage de vos campagnes digitales.',
                'benefits' => [
                    'Le pilotage de vos campagnes digitales.',
                    'Community management au quotidien.',
                    'Un accompagnement web marketing dédié.',
                ],
                'deliverables' => [
                    'Pilotage de vos campagnes digitales.',
                    'Community management et animation de vos réseaux.',
                    'Mise en œuvre opérationnelle de vos actions web marketing.',
                ],
                'related' => ['veille', 'commercial'],
            ],
            [
                'slug'    => 'externalisation-rh',
                'title'   => 'Externalisation RH',
                'lead'    => 'Sourcing, tri de CV et prospection commerciale au service des cabinets RH.',
                'icon'    => 'users',
                'summary' => 'Sourcing, tri de CV et prospection commerciale au service des cabinets RH.',
                'benefits' => [
                    'Un binôme dédié à vos campagnes de recrutement.',
                    'Une hausse mesurable du volume de CV qualifiés.',
                    'Une confidentialité et une éthique irréprochables.',
                ],
                'deliverables' => [
                    'Premiers tris de CV par rapport à des offres de recrutement.',
                    'Prospection RH auprès de candidats ciblés.',
                    'Prospection commerciale RH / recrutement / outplacement.',
                ],
                'related' => ['commercial', 'admin-finances'],
            ],
            [
                'slug'    => 'admin-finances',
                'title'   => 'Externalisation Admin & Finances',
                'lead'    => 'Du traitement auprès des partenaires au suivi de trésorerie et à la gestion des éléments comptables réglementaires et légaux.',
                'icon'    => 'ledger',
                'summary' => 'Du traitement auprès des partenaires au suivi de trésorerie et à la gestion des éléments comptables réglementaires et légaux.',
                'benefits' => [
                    'Traitement administratif auprès de vos partenaires.',
                    'Suivi de trésorerie au fil de l’eau.',
                    'Gestion des éléments comptables réglementaires et légaux.',
                ],
                'deliverables' => [
                    'Traitement auprès des partenaires.',
                    'Suivi de trésorerie.',
                    'Gestion des éléments comptables réglementaires et légaux.',
                ],
                'related' => ['commercial', 'autres'],
            ],
            [
                'slug'    => 'developpement-web',
                'title'   => 'Développement web',
                'lead'    => 'De la conception à la maintenance de vos sites et applications avec une équipe technique dédiée.',
                'icon'    => 'code',
                'summary' => 'De la conception à la maintenance de vos sites et applications avec une équipe technique dédiée.',
                'benefits' => [
                    'Une équipe technique dédiée.',
                    'De la conception à la mise en production.',
                    'Maintenance de vos sites et applications.',
                ],
                'deliverables' => [
                    'Conception de sites et d’applications.',
                    'Développement et mise en production.',
                    'Maintenance de vos sites et applications.',
                ],
                'related' => ['administration-systemes', 'web-marketing'],
            ],
            [
                'slug'    => 'administration-systemes',
                'title'   => 'Administration systèmes et réseaux',
                'lead'    => 'Sécurisation de vos infrastructures informatiques.',
                'icon'    => 'server',
                'summary' => 'Sécurisation de vos infrastructures informatiques.',
                'benefits' => [
                    'Sécurisation de vos infrastructures informatiques.',
                    'Administration des systèmes.',
                    'Administration des réseaux.',
                ],
                'deliverables' => [
                    'Sécurisation de vos infrastructures informatiques.',
                    'Administration des systèmes.',
                    'Administration des réseaux.',
                ],
                'related' => ['developpement-web', 'autres'],
            ],
            [
                'slug'    => 'autres',
                'title'   => 'Autres missions',
                'lead'    => 'Ce que nous ne rangeons dans aucune case : c’est souvent là que se joue votre différenciation.',
                'icon'    => 'sparkle',
                'summary' => 'Ce que nous ne rangeons dans aucune case : c’est souvent là que se joue votre différenciation.',
                'benefits' => [
                    'Un interlocuteur unique pour vos projets à Madagascar.',
                    'Une Due Diligence de vos partenaires locaux.',
                    'Un pilotage rigoureux tout au long de la mission.',
                ],
                'deliverables' => [
                    'Documents de communication et de présentation.',
                    'Supports de formation en présentiel et e-learning.',
                    'Pilotage de vos missions d’externalisation à Madagascar : sélection du partenaire local, Due Diligence, contrôle du bon déroulé.',
                ],
                'related' => ['externalisation-rh', 'etudes'],
            ],
        ];
    }

    public static function service(string $slug): ?array
    {
        foreach (self::services() as $service) {
            if ($service['slug'] === $slug) {
                return $service;
            }
        }
        return null;
    }

    /** Shared process on every service sheet. */
    public static function serviceProcess(): array
    {
        return [
            ['Cadrage', 'Nous formalisons ensemble vos objectifs, périmètre et indicateurs.'],
            ['Recrutement dédié', 'Nous identifions et vous présentons le ou les profils pressentis.'],
            ['Onboarding', 'Immersion dans votre culture, vos outils et votre langage.'],
            ['Pilotage', 'Reportings hebdomadaires, points mensuels, ajustement du dispositif.'],
        ];
    }

    /** Method / values shown on the About page. */
    public static function values(): array
    {
        return [
            [
                'title' => 'Contrôle',
                'body'  => 'Des reportings hebdomadaires vous permettent d’assurer un suivi permanent de la mission confiée. Au-delà de 3 mois d’engagement, vous participez au processus de sélection de votre candidat.',
            ],
            [
                'title' => 'Qualité',
                'body'  => 'Nos profils vous permettent de maintenir un niveau de prestations en cohérence avec les besoins de votre mission et de votre organisation.',
            ],
            [
                'title' => 'Gestion des coûts',
                'body'  => 'Pas de coûts cachés : nous vous garantissons une transparence totale en termes de facturation.',
            ],
            [
                'title' => 'Flexibilité',
                'body'  => 'Nous nous adaptons à vos besoins et vous proposons une souplesse que ne permet pas l’environnement légal et fiscal du droit du travail français.',
            ],
        ];
    }

    /** Directeur général quote block. */
    public static function director(): array
    {
        return [
            'name'    => 'Jonathan Ranjatoelina',
            'role'    => 'Fondateur et Directeur général',
            'photo'   => '/assets/images/team/jonathan-ranjatoelina.jpg',
            'quote'   => 'Nous voulons inventer un nouveau modèle d’externalisation, au service des PME et start-ups.',
            'paragraphs' => [
                'Ayant travaillé pendant 3 ans au conseil RH à Paris, où je côtoyais au quotidien des dirigeants de PME et des entrepreneurs, je me suis aperçu qu’ils étaient oubliés des métiers de l’externalisation.',
                'Notre modèle consiste à monter en gamme en matière de prestations et à placer l’humain au centre de l’organisation. Chez BSM-Services, nous croyons aux vertus de l’intuitu personae et sommes convaincus que la différence est une richesse, source de réussite.',
                'Nous recrutons des profils identiques à ceux que vous auriez recrutés en interne : nos collaborateurs vous sont exclusivement dédiés.',
            ],
        ];
    }

    /** Key facts used on the homepage stats band. */
    public static function facts(): array
    {
        return [
            ['value' => '2016', 'label' => 'Année de fondation'],
            ['value' => 'Bac +4/5', 'label' => 'Profils exclusivement sélectionnés'],
            ['value' => (string) count(self::services()), 'label' => 'Familles de prestations'],
            ['value' => '100 %', 'label' => 'Collaborateurs dédiés'],
        ];
    }

    /**
     * Recrutement — copy sourced from the site-text draft.
     */
    public static function recruitment(): array
    {
        return [
            'steps' => [
                [
                    'title' => 'Un besoin identifié',
                    'body'  => 'Nous étudions chaque demande de manière spécifique et trouvons les ressources clés correspondant à vos besoins.',
                ],
                [
                    'title' => 'Une sélection exigeante',
                    'body'  => 'Nous recrutons des profils jeunes diplômés Bac+4/5, sortants des meilleures écoles et de l’Université d’Antananarivo, et les faisons grandir à nos côtés.',
                ],
                [
                    'title' => 'Votre regard sur le profil',
                    'body'  => 'Au-delà de 3 mois d’engagement, vous participez au processus de sélection du candidat qui vous sera attribué.',
                ],
                [
                    'title' => 'Un collaborateur dédié',
                    'body'  => 'Chaque collaborateur est affecté à un projet client identifié avant même son recrutement ; il vous est exclusivement dédié.',
                ],
            ],
            'process' => [
                [
                    'title' => 'Votre profil',
                    'body'  => 'Envoyez-nous votre CV et votre lettre de motivation ; chaque candidature est étudiée au regard de nos missions actuelles et à venir.',
                ],
                [
                    'title' => 'Nous sélectionnons',
                    'body'  => 'Premiers échanges avec notre équipe RH sur votre parcours, vos compétences et vos aspirations.',
                ],
                [
                    'title' => 'Le client vous rencontre',
                    'body'  => 'Au-delà de 3 mois d’engagement, notre client participe au processus de sélection et rencontre les candidats retenus.',
                ],
                [
                    'title' => 'Vous êtes dédié(e) au projet',
                    'body'  => 'Vous rejoignez BSM-Services, exclusivement affecté(e) à un projet client identifié dès votre arrivée.',
                ],
            ],
            'jobs' => [
                [
                    'slug'     => 'commercial',
                    'open'     => true,
                    'title'    => 'Chargé(e) d’affaires commercial',
                    'pole'     => 'Commercial',
                    'contract' => 'CDI',
                    'schedule' => 'Temps plein',
                    'location' => 'Antananarivo',
                    'lead'     => 'Structurez et accélérez le développement commercial d’un client français, en lui étant exclusivement dédié(e).',
                    'missions' => [
                        'Prospection commerciale téléphonique (1 ou 2 ETP).',
                        'Rédaction de propositions commerciales et de réponses à appels d’offres.',
                        'Mise en place de documents commerciaux : plaquettes, flyers, ciblage de prospects.',
                    ],
                    'profile'  => [
                        'Bac+4/5, école de commerce ou Université d’Antananarivo.',
                        'Français écrit et oral irréprochable.',
                        'Aisance relationnelle et goût pour le développement commercial.',
                    ],
                ],
                [
                    'slug'     => 'veille',
                    'open'     => true,
                    'title'    => 'Chargé(e) de veille',
                    'pole'     => 'Veille',
                    'contract' => 'CDI',
                    'schedule' => 'Temps plein',
                    'location' => 'Antananarivo',
                    'lead'     => 'Anticipez les tendances de marché d’un client dédié, avec une veille structurée et exploitable.',
                    'missions' => [
                        'Veille proactive pour anticiper les futures tendances du marché du client.',
                        'Conception de books de tendance pour consultants et cabinets de conseil.',
                        'Missions de veille prospective sur horizons 6 à 24 mois.',
                    ],
                    'profile'  => [
                        'Bac+4/5, école de commerce ou Université d’Antananarivo.',
                        'Rigueur d’analyse et aisance rédactionnelle en français.',
                        'Curiosité pour les écosystèmes économiques et sectoriels.',
                    ],
                ],
                [
                    'slug'     => 'marketing',
                    'open'     => true,
                    'title'    => 'Chargé(e) de marketing',
                    'pole'     => 'Community Management et Web marketing',
                    'contract' => 'CDI',
                    'schedule' => 'Temps plein',
                    'location' => 'Antananarivo',
                    'lead'     => 'Pilotez les campagnes digitales d’un client dédié, en community management et web marketing.',
                    'missions' => [
                        'Pilotage de vos campagnes digitales.',
                        'Community management et animation de vos réseaux.',
                        'Mise en œuvre opérationnelle de vos actions web marketing.',
                    ],
                    'profile'  => [
                        'Bac+4/5, école de commerce ou Université d’Antananarivo.',
                        'Appétence pour le digital et la mise en action opérationnelle.',
                        'Français écrit et oral irréprochable.',
                    ],
                ],
                [
                    'slug'     => 'rh',
                    'open'     => true,
                    'title'    => 'Chargé(e) de recrutement',
                    'pole'     => 'Externalisation RH',
                    'contract' => 'CDI',
                    'schedule' => 'Temps plein',
                    'location' => 'Antananarivo',
                    'lead'     => 'Fluidifiez les process de recrutement d’un cabinet ou d’une PME, au sein d’une équipe RH dédiée.',
                    'missions' => [
                        'Premiers tris de CV par rapport à des offres de recrutement.',
                        'Prospection RH auprès de candidats ciblés.',
                        'Prospection commerciale RH / recrutement / outplacement.',
                    ],
                    'profile'  => [
                        'Bac+4/5, école de commerce ou Université d’Antananarivo.',
                        'Discrétion, éthique et sens du relationnel.',
                        'Intérêt pour les métiers des ressources humaines.',
                    ],
                ],
                [
                    'slug'     => 'etudes',
                    'open'     => true,
                    'title'    => 'Chargé(e) d’Études & Business Plan',
                    'pole'     => 'Études de marché',
                    'contract' => 'CDI',
                    'schedule' => 'Temps plein',
                    'location' => 'Antananarivo',
                    'lead'     => 'Sécurisez les décisions stratégiques d’un client dédié, avec des études rigoureuses et des Business Plans robustes.',
                    'missions' => [
                        'Études de marché pour création d’entreprise ou nouvelle Business Unit.',
                        'Rédaction de Business Plans narratifs et financiers à plusieurs hypothèses.',
                    ],
                    'profile'  => [
                        'Bac+4/5, école de commerce ou Université d’Antananarivo.',
                        'Aisance avec les hypothèses financières et la méthodologie.',
                        'Rigueur, clarté rédactionnelle et esprit de synthèse.',
                    ],
                ],
            ],
            'faq' => [
                [
                    'q' => 'Quels profils recrutez-vous ?',
                    'a' => 'Des jeunes diplômés Bac+4/5, sortants des meilleures écoles de commerce et de l’Université d’Antananarivo, quel que soit leur domaine (commercial, marketing, RH, études…).',
                ],
                [
                    'q' => 'Où se trouvent les postes ?',
                    'a' => 'L’ensemble de nos missions se déroulent depuis nos bureaux d’Antananarivo, dans le quartier d’Ankorahotra.',
                ],
                [
                    'q' => 'Comment postuler à une offre ?',
                    'a' => 'Cliquez sur « Postuler » depuis l’offre qui vous intéresse, ou envoyez une candidature spontanée si aucune offre ne correspond à votre profil.',
                ],
                [
                    'q' => 'Acceptez-vous les candidatures spontanées ?',
                    'a' => 'Oui, nous étudions chaque candidature spontanée au regard de nos missions en cours et à venir.',
                ],
                [
                    'q' => 'Le client participe-t-il au recrutement ?',
                    'a' => 'Au-delà de 3 mois d’engagement, notre client participe au processus de sélection du ou des candidats qui lui seront attribués.',
                ],
                [
                    'q' => 'Serai-je dédié(e) à un seul client ?',
                    'a' => 'Oui, chaque collaborateur est affecté à un projet client identifié avant même son recrutement, et lui est exclusivement dédié.',
                ],
                [
                    'q' => 'Quel délai avant de recevoir une réponse ?',
                    'a' => 'Nous revenons vers chaque candidat sous 24h ouvrées suivant réception de sa candidature.',
                ],
            ],
            'rh_missions' => [
                'Premiers tris de CV par rapport à des offres de recrutement.',
                'Prospection RH auprès de candidats ciblés.',
                'Prospection commerciale RH / recrutement / outplacement.',
            ],
        ];
    }
}
