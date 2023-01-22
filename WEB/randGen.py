import numpy as np
from datetime import datetime as dt
from requests import get

def date_gen(year, month):
    long = [1,3,5,7,8,10,12]
    dates = []
    
    for i in range(1, 32):
        dates.append(str(year) + str(month).zfill(2) + str(i).zfill(2))
        
        if(month == 2 and i >= 28):
            break
        
        if(month not in long and i >= 30):
            break
        
    return dates

def gen_requests(user, dates, consumption, lim = 32):
    for i in range(len(consumption)):
        rq = 'http://localhost/hp1/s/e.php?i={}&c={}&d={}'.format(users[user], str(consumption[i]), dates[i])
        print(rq)
        print(get(rq))
        
        if(i == lim): break

def main(lim = 32):
    year, month = list(map(int, input().split()))
    dates = date_gen(year, month)
    
    # now generate the consumption values using normal dist

    mean = 2.67 * np.random.rand() + 2.33      # random mean per day between 2.33 - 5
    std = 1.3 * np.random.rand() + 0.7    # std between -> 0 - 2.7

    consumption = np.random.normal(loc=mean, scale=std, size=(len(dates)))
    
    gen_requests('wikum', dates, consumption, lim)

users = {
    'yasiru' : '150150150',
    'wikum'  : '12343211'
}

main(14)
