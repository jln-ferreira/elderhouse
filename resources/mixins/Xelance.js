export default {
    data(){
        return{

        }
    },
    methods: {
        dayFixer( day ){
            switch ( day ) {
                case 0:
                    day = "Domingo";
                    break;
                case 1:
                    day = "Segunda-feira";
                    break;
                case 2:
                    day = "Terça-feira";
                    break;
                case 3:
                    day = "Quarta-feira";
                    break;
                case 4:
                    day = "Quinta-feira";
                    break;
                case 5:
                    day = "Sexta-feira";
                    break;
                default:
                    day = "Sabado";
                break;
        }
        return day;
    },

    monthFixer( month ){
        switch ( month ) {
            case 1:
                month = "Janeiro";
                break;
            case 2:
                month = "Fevereiro";
                break;
            case 3:
                month = "Março";
                break;
            case 4:
                month = "Abril";
                break;
            case 5:
                month = "Maio";
                break;
            case 6:
                month = "Junho";
                break;
            case 7:
                month = "Julho";
                break;
            case 8:
                month = "Agosto";
                break;
            case 9:
                month = "Setembro";
                break;
            case 10:
                month = "Outubro";
                break;
            case 11:
                month = "Novembro";
                break;
            default:
                month = "Dezembro";
                break;
        }
        return month;
    },
        // 2021-03 -> Março/2021
        fixMonthYear(date)
        {
            let splitDate = date.split("-");
            return this.monthFixer(parseInt(splitDate[1])) + "/" + splitDate[0];
        }
    },
    created(){

    }
}
