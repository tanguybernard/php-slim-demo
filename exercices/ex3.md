# Exercise 3

## Objective

- Create a real estate advertisement site offering a financing plan to visitors.
- Create a form to enter the data needed to calculate the loan.

## Statement

![Real Estate Loan](img/real_estate_loan.png)


- Display the monthly payment excluding insurance as well as the amortization table containing, among other things, the remaining capital due and the interest for each period.


Formula for calculating monthly consumer loan payments


    m = [C × (t/12)] / [1 – (1 + (t/12)^-(12 × n))]

    m : monthly payment (mensualité)
    C : amount (montant)
    t : the rate (taux)
    n : number of years (nombre d'années)


Let's calculate the monthly payment for a constant repayment loan of 100,000 euros at an annual proportional rate of 4% over a period of 20 years (240 months).

Applying the formula we get :

    m = [100000 × 0,04/12] / [1−(1+ (0,04/12))^-(12*20)] 

    m = 605,98€


note: in the formula 4% becomes 4/100 = 0.04



Total cost of interest

    12*n*m-C


If you borrowed 100,000€ over 20 years, and your monthly payment is 605.98€, the total interest cost is :

    12*20*605,98-100000 = 45440 €


Calculate the interest on an amortizing loan:



1st monthly payment


    (100 000 € * 4 %) / 12 = 333,33 €


Let's calculate the return capital of (Capital restant du):


    605,98 -333,33 = 272,64 €
    
    100 000 - (605,98 -333,33) = 99727 (arrondis)
    
    Capital Retant du 99727 €

2nd monthly payment

    (99727 € * 4 %) / 12 = 332,42 € 


-------

En résumé :


Prêt à taux fixe

- Somme totale empruntée : 100 000 €
- Taux d'intérêt : 4 %
- Durée de l'emprunt 240 mois


| Echeance | Intérets | Amortissement  | Le capital restant dû (CRD) | Mensualité |
|:--------:|:--------:|:--------------:|:---------------------------:|:----------:|
|    1     | 333,33 € |    272,64 €    |         99 727,00 €         |  605,98 €  |
|    2     | 332,42 € |    273,55 €    |         99 454,00 €         |  605,98 €  |
|    3     | 331,51 € |    274,46 €    |         99 179,00 €         |  605,98 €  |
|    ..    |    ..    |       ..       |             ..              |     ..     |
|   240    |  2,01 €  |    603,96 €    |             0 €             |  605,98 €  |


