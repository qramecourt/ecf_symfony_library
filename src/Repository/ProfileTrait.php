<?php

namespace App\Repository;
use App\Entity\User;
    //permet de "recopier" des méthodes
    Trait profileTrait {
        private function __findByUser(User $user) {
            return $this->createQueryBuilder('p')
                // je fais la jointure sur le User avvec e, et le renomme u
            ->join('p.User','u')
            //je ne retiens que le profil éditeur associé à l'utilisateur passé en paramètre de la fonction.
            ->andWhere('u.id = :userId')
            ->setParameter('userId', $user->getId())
            //j'exécute la requete 
            ->getQuery()
            ->getOnerOrNullResult();
        }
    }