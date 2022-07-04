#include <iostream>
namespace std;
int main()

{
int num1,num2,num3;
cout<<"enter three numbers";
cin>>num1>>num2>>num3;
if(num1>num2)
 swap(num2,num1)

if(num2>num3)
    swap(num3,num2)
if(num1>num3)
    swap(num3,num1)
cout<<num1<<num2<<num3; 
}