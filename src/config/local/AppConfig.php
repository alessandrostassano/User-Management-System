<?php
namespace sarassoroberto\usm\config\local;

class AppConfig {
    const DB_PASSWORD = '';
    const DB_USER = 'root';
    const DB_NAME = 'usm_3';
    const DB_HOST = 'localhost';
}

/*- Creare la tabella Interesse(InteresseId,nome)
- Creare la tabella User_Interesse(UserId,InteresseId)
- Chiave unica per User_Interesse unique(UserId,InteresseId) (facoltativo)

- Creare il CRUD (InteresseModel)

# Modificare il CRUD degli utenti 
- [ ] Form Permettere di selezionare un interesse
- [ ] UserModel modificare le query/metodi inserendo l'interesse
      
      - [ ] CREATE USER - Come ottenere id di un utente appena creato ?
      - [ ] Inserire nella tabella User_Interesse UserId appena creato e InteresseId selezionato
  
      - [ ] EDIT USER - Devo trovare l'interesse compilato dall'utente in fase di iscrizione già selezionato [selecthtml](https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_select)
      - [ ] DELETE USER - cancellare il suo riferimento anche nella tabella
      User_Interesse
      - [ ] DELETE Interesse - cancellare il suo riferimento anche nella tabella
      User_Interesse
      - EDIT USER - Cambio id di riferimento nella tabella User_Interesse*/

