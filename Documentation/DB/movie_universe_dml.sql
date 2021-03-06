SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

INSERT INTO actor (id, name, surname) VALUES (1, 'Samuel L.', 'Jackson');
INSERT INTO actor (id, name, surname) VALUES (2, 'John', 'Travolta');
INSERT INTO actor (id, name, surname) VALUES (3, 'Morgan', 'Freeman');
INSERT INTO actor (id, name, surname) VALUES (4, 'Marlon', 'Brando');
INSERT INTO actor (id, name, surname) VALUES (5, 'Tom', 'Hanks');

INSERT INTO genre (id, name) VALUES (1, 'dramat');
INSERT INTO genre (id, name) VALUES (2, 'gangsterski');
INSERT INTO genre (id, name) VALUES (3, 'komedia');

INSERT INTO movie (id, genre_id, title, description, price, pathtocover) VALUES (1, 1, 'Skazani na Shawshank', 'Adaptacja opowiadania Stephena Kinga. Historia niesłusznie skazanego na dożywocie bankiera, który musi przeżyć w brutalnym świecie rządzonym przez strażników i współwięźniów.', 19.99, '/');
INSERT INTO movie (id, genre_id, title, description, price, pathtocover) VALUES (2, 1, 'Zielona mila', 'Emerytowany strażnik więzienny opowiada przyjaciółce o niezwykłym mężczyźnie, którego skazano na śmierć za zabójstwo dwóch 9-letnich dziewczynek.', 14.99, '/');
INSERT INTO movie (id, genre_id, title, description, price, pathtocover) VALUES (3, 2, 'Ojciec chrzestny', 'Opowieść o nowojorskiej rodzinie mafijnej. Starzejący się Don Corleone pragnie przekazać władzę swojemu synowi.', 9.99, '/');
INSERT INTO movie (id, genre_id, title, description, price, pathtocover) VALUES (4, 2, 'Pulp Fiction', 'Przemoc i odkupienie w opowieści o dwóch płatnych mordercach pracujących na zlecenie mafii, żonie gangstera, bokserze i parze okradającej ludzi w restauracji.', 12.99, '/');
INSERT INTO movie (id, genre_id, title, description, price, pathtocover) VALUES (5, 3, 'Forrest Gump', 'Forrest Gump;Historia życia Forresta, chłopca o niskim ilorazie inteligencji z niedowładem kończyn, który staje się miliarderem i bohaterem wojny w Wietnamie.', 8.99, '/');

INSERT INTO movies_actors (movie_id, actor_id) VALUES (1, 3);
INSERT INTO movies_actors (movie_id, actor_id) VALUES (2, 5);
INSERT INTO movies_actors (movie_id, actor_id) VALUES (3, 4);
INSERT INTO movies_actors (movie_id, actor_id) VALUES (4, 1);
INSERT INTO movies_actors (movie_id, actor_id) VALUES (4, 2);
INSERT INTO movies_actors (movie_id, actor_id) VALUES (5, 5);

INSERT INTO orderstatus (id, status) VALUES (1, 'PENDING');
INSERT INTO orderstatus (id, status) VALUES (2, 'TO_PAY');
INSERT INTO orderstatus (id, status) VALUES (3, 'COMPLETED');
INSERT INTO orderstatus (id, status) VALUES (4, 'CANCELLED');

INSERT INTO review (id, movie_id, reviewcontent) VALUES (1, 1, 'Film nakręcony na podstawie książki mistrza horrorów Stephena Kinga. Andy Dufresne (Tim Robbins), dobrze zarabiający bankier z Nowej Anglii, zostaje oskarżony o podwójne zabójstwo - swojej żony i jej kochanka. Uparcie twierdzi, że jest niewinny, ale dzięki niezbitym dowodom zostaje skazany na podwójne dożywocie w więzieniu Shawshank. Shawshank rządzi hipokryta i fanatyk biblijny, naczelnik Norton (Bob Gunton), a wraz z nim sadystyczni strażnicy. Andy już po kilku dniach poznaje brutalną, więzienną rzeczywistość, ale dzięki wrodzonej inteligencji, sprytowi oraz pomocy przyjaciela Ellisa Boyda "Reda" Reddinga (Morgan Freeman) udaje mu się zachować nadzieję, która pozwoli dokonać zemsty.');
INSERT INTO review (id, movie_id, reviewcontent) VALUES (2, 2, 'Rok 1935. Paul Edgecombe (Tom Hanks) jest jednym ze strażników bloku śmierci w więzieniu Cold Mountain. Do jego obowiązków należy odprowadzanie skazańców do celi śmierci długim korytarzem, wyłożonym zieloną wykładziną, zwaną "Zieloną milą". Pewnego dnia do więzienia przybywa olbrzymi czarnoskóry skazaniec, John Coffey (Michael Clarke Duncan). Ma oczekiwać na karę śmierci za zamordowanie dwóch białych dziewczynek. Jego wizyta na zawsze zmieni życie Paula i pozostałych pracowników więzienia.');
INSERT INTO review (id, movie_id, reviewcontent) VALUES (3, 3, '"Zawsze chciałem pokazać mafię jako metaforę Ameryki. I mafia, i Ameryka mają swe korzenie w Europie" - powiedział Coppola. Film oparty jest na słynnej powieści Mario Puzo, amerykańskiego pisarza pochodzenia włoskiego, która stała się światowym bestsellerem i przyniosła autorowi fortunę. Ukazuje on amerykańskie społeczeństwo lat 1945-1955 i więzy łączące mafię z rozmaitymi środowiskami, od Waszyngtonu po Hollywood. Przedstawia dzieje rodziny Corleone, z jej Ojcem Chrzestnym, Vito Corleone (znakomita kreacja Marlona Brando) na czele. Piękne zdjęcia, muzyka, którą zachwycił się cały świat i doskonała obsada aktorska są dodatkowymi atutami tej mistrzowsko sfilmowanej gangsterskiej sagi. Film Coppoli zdobył trzy Oscary.');
INSERT INTO review (id, movie_id, reviewcontent) VALUES (4, 4, 'Płatni mordercy, Jules (Samuel L. Jackson) i Vincent (John Travolta), dostają zlecenie, by odzyskać z rąk przypadkowych rabusiów tajemniczą walizkę bossa mafii. Nie dość tego, Vincent dostaje kolejną robotę - na czas nieobecności gangstera w mieście ma zaopiekować się jego poszukującą wrażeń żoną Mią (Uma Thurman). Vincent i Jules niespodziewanie wpadają po uszy, gdy przypadkowo zabijają zakładnika. Kłopoty ma też podupadły bokser (Bruce Willis), który otrzymał dużą sumę za przegranie swojej walki. Walkę jednak wygrywa, a Los Angeles staje się od tej chwili dla niego za małe. Specjaliści od mokrej roboty będą mieli co robić... ');
INSERT INTO review (id, movie_id, reviewcontent) VALUES (5, 5, '"Forrest Gump" to romantyczna historia, w której Tom Hanks wcielił się w tytułową postać - nierozgarniętego młodego człowieka o wielkim sercu i zdolności do odnajdywania się w największych wydarzeniach w historii USA, począwszy od swego dzieciństwa w latach 50-tych. Po tym, jak staje się gwiazdą footballu, odznaczonym bohaterem wojennym i odnoszącym sukcesy biznesmenem, główny bohater zyskuje status osobistości, lecz nigdy nie rezygnuje z poszukiwania tego, co dla niego najważniejsze - miłości swej przyjaciółki, Jenny Curran. Forrest jest małym chłopcem, kiedy jego ojciec porzuca rodzinę, a matka utrzymuje siebie i syna biorąc pod swój dach lokatorów. Kiedy okazuje się, że jej chłopiec ma bardzo niski iloraz inteligencji, pozostaje nieustraszona w swoim przekonaniu, że ma on takie same możliwości, jak każdy inny. To prawda - takie same, a nawet dużo większe. W całym swym życiu Forrest niezamierzenie znajduje się twarzą w twarz z wieloma legendarnymi postaciami lat 50-tych, 60-tych i 70-tych. Wiedzie go to na boisko piłki nożnej, poprzez dżungle Wietnamu, Waszyngton, Chiny, Nowy Jork, do Luizjany i w wiele innych miejsc, a wszystko to relacjonuje on w swych poruszających i wstrząsających opowieściach przypadkowo spotkanym osobom.');